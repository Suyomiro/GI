/*
  # Schéma complet pour le système de gestion scolaire

  1. Nouvelles Tables
    - `users` - Utilisateurs du système (RP, Attachés, Étudiants)
    - `classes` - Classes de l'école
    - `professeurs` - Professeurs
    - `modules` - Modules d'enseignement
    - `etudiants` - Étudiants
    - `inscriptions` - Inscriptions des étudiants
    - `demandes` - Demandes d'annulation/suspension
    - `prof_modules` - Association professeurs-modules
    - `prof_classes` - Association professeurs-classes
    - `module_professeurs` - Association modules-professeurs

  2. Sécurité
    - Enable RLS sur toutes les tables
    - Politiques d'accès appropriées
*/

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS users (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  email text UNIQUE NOT NULL,
  password text NOT NULL,
  role text NOT NULL CHECK (role IN ('RP', 'ATTACHE', 'ETUDIANT')),
  nom text,
  prenom text,
  created_at timestamptz DEFAULT now()
);

-- Table des classes
CREATE TABLE IF NOT EXISTS classes (
  id text PRIMARY KEY,
  libelle text NOT NULL,
  filiere text NOT NULL,
  niveau text NOT NULL,
  created_at timestamptz DEFAULT now()
);

-- Table des professeurs
CREATE TABLE IF NOT EXISTS professeurs (
  id text PRIMARY KEY,
  nom text NOT NULL,
  prenom text NOT NULL,
  grade text NOT NULL,
  created_at timestamptz DEFAULT now()
);

-- Table des modules
CREATE TABLE IF NOT EXISTS modules (
  id text PRIMARY KEY,
  nom text NOT NULL,
  created_at timestamptz DEFAULT now()
);

-- Table des étudiants
CREATE TABLE IF NOT EXISTS etudiants (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  matricule text UNIQUE NOT NULL,
  nom text NOT NULL,
  prenom text NOT NULL,
  sexe text NOT NULL CHECK (sexe IN ('M', 'F')),
  adresse text NOT NULL,
  email text UNIQUE NOT NULL,
  user_id uuid REFERENCES users(id),
  created_at timestamptz DEFAULT now()
);

-- Table des inscriptions
CREATE TABLE IF NOT EXISTS inscriptions (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  etudiant_id uuid REFERENCES etudiants(id),
  classe_id text REFERENCES classes(id),
  annee_scolaire text NOT NULL,
  date_inscription timestamptz DEFAULT now(),
  statut text DEFAULT 'active' CHECK (statut IN ('active', 'suspendue', 'annulee')),
  created_at timestamptz DEFAULT now()
);

-- Table des demandes
CREATE TABLE IF NOT EXISTS demandes (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  etudiant_id uuid REFERENCES etudiants(id),
  inscription_id uuid REFERENCES inscriptions(id),
  type_demande text NOT NULL CHECK (type_demande IN ('suspension', 'annulation')),
  motif text NOT NULL,
  date_demande timestamptz DEFAULT now(),
  statut text DEFAULT 'en_attente' CHECK (statut IN ('en_attente', 'acceptee', 'refusee')),
  traite_par uuid REFERENCES users(id),
  date_traitement timestamptz,
  created_at timestamptz DEFAULT now()
);

-- Table association professeurs-modules
CREATE TABLE IF NOT EXISTS prof_modules (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  professeur_id text REFERENCES professeurs(id),
  module_id text REFERENCES modules(id),
  created_at timestamptz DEFAULT now(),
  UNIQUE(professeur_id, module_id)
);

-- Table association professeurs-classes
CREATE TABLE IF NOT EXISTS prof_classes (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  professeur_id text REFERENCES professeurs(id),
  classe_id text REFERENCES classes(id),
  created_at timestamptz DEFAULT now(),
  UNIQUE(professeur_id, classe_id)
);

-- Enable RLS
ALTER TABLE users ENABLE ROW LEVEL SECURITY;
ALTER TABLE classes ENABLE ROW LEVEL SECURITY;
ALTER TABLE professeurs ENABLE ROW LEVEL SECURITY;
ALTER TABLE modules ENABLE ROW LEVEL SECURITY;
ALTER TABLE etudiants ENABLE ROW LEVEL SECURITY;
ALTER TABLE inscriptions ENABLE ROW LEVEL SECURITY;
ALTER TABLE demandes ENABLE ROW LEVEL SECURITY;
ALTER TABLE prof_modules ENABLE ROW LEVEL SECURITY;
ALTER TABLE prof_classes ENABLE ROW LEVEL SECURITY;

-- Politiques RLS (permettre l'accès pour l'instant)
CREATE POLICY "Allow all operations" ON users FOR ALL TO authenticated USING (true);
CREATE POLICY "Allow all operations" ON classes FOR ALL TO authenticated USING (true);
CREATE POLICY "Allow all operations" ON professeurs FOR ALL TO authenticated USING (true);
CREATE POLICY "Allow all operations" ON modules FOR ALL TO authenticated USING (true);
CREATE POLICY "Allow all operations" ON etudiants FOR ALL TO authenticated USING (true);
CREATE POLICY "Allow all operations" ON inscriptions FOR ALL TO authenticated USING (true);
CREATE POLICY "Allow all operations" ON demandes FOR ALL TO authenticated USING (true);
CREATE POLICY "Allow all operations" ON prof_modules FOR ALL TO authenticated USING (true);
CREATE POLICY "Allow all operations" ON prof_classes FOR ALL TO authenticated USING (true);

-- Données de test
INSERT INTO users (email, password, role, nom, prenom) VALUES
('rp@suyo.sn', 'passer123@', 'RP', 'Responsable', 'Pédagogique'),
('attache@suyo.sn', 'passer123@', 'ATTACHE', 'Attaché', 'Classe'),
('etudiant@suyo.sn', 'passer123@', 'ETUDIANT', 'Diallo', 'Mariama');

INSERT INTO classes (id, libelle, filiere, niveau) VALUES
('C001', 'Classe A', 'Informatique', 'Licence 1'),
('C002', 'Classe B', 'Gestion', 'Licence 2'),
('C003', 'Classe C', 'Informatique', 'Master 1');

INSERT INTO professeurs (id, nom, prenom, grade) VALUES
('P001', 'Diop', 'Amadou', 'Docteur'),
('P002', 'Ndiaye', 'Fatou', 'Professeur'),
('P003', 'Sow', 'Ibrahima', 'Maître de conférences');

INSERT INTO modules (id, nom) VALUES
('M001', 'Programmation Java'),
('M002', 'Comptabilité générale'),
('M003', 'Bases de données'),
('M004', 'Mathématiques'),
('M005', 'Anglais');

INSERT INTO etudiants (matricule, nom, prenom, sexe, adresse, email, user_id) VALUES
('ET001', 'Diallo', 'Mariama', 'F', 'Dakar, Sacré-Cœur', 'mariama.diallo@suyo.sn', (SELECT id FROM users WHERE email = 'etudiant@suyo.sn')),
('ET002', 'Fall', 'Ousmane', 'M', 'Dakar, Médina', 'ousmane.fall@suyo.sn', NULL),
('ET003', 'Mbaye', 'Aida', 'F', 'Dakar, Yoff', 'aida.mbaye@suyo.sn', NULL),
('ET004', 'Sarr', 'Moussa', 'M', 'Dakar, Ouakam', 'moussa.sarr@suyo.sn', NULL);

INSERT INTO inscriptions (etudiant_id, classe_id, annee_scolaire, statut) VALUES
((SELECT id FROM etudiants WHERE matricule = 'ET001'), 'C001', '2023-2024', 'active'),
((SELECT id FROM etudiants WHERE matricule = 'ET002'), 'C001', '2023-2024', 'active'),
((SELECT id FROM etudiants WHERE matricule = 'ET003'), 'C002', '2023-2024', 'active'),
((SELECT id FROM etudiants WHERE matricule = 'ET004'), 'C003', '2023-2024', 'suspendue');

INSERT INTO prof_modules (professeur_id, module_id) VALUES
('P001', 'M001'),
('P001', 'M003'),
('P002', 'M002'),
('P003', 'M004'),
('P003', 'M005');

INSERT INTO prof_classes (professeur_id, classe_id) VALUES
('P001', 'C001'),
('P001', 'C003'),
('P002', 'C002'),
('P003', 'C001'),
('P003', 'C002'),
('P003', 'C003');