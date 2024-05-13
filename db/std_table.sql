CREATE DATABASE if not EXISTS student;
USE student;

CREATE TABLE IF NOT EXISTS stdtable (
  std_id INT NOT NULL,
  std_name VARCHAR(200) NOT NULL,
  std_cgpa FLOAT NOT NULL,
  CONSTRAINT chk_cgpa CHECK (std_cgpa <= 4),
  PRIMARY KEY (std_id)
);

INSERT INTO stdtable (std_id, std_name, std_cgpa)
VALUES 
  (2202129, 'mrawan elesayed', 4.0),
  (22011417, 'mohamed sayed',  4.0),
  (2203181, 'mohamed amgad', 4.0); 