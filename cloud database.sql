create database std_info;
CREATE SCHEMA student;
use std_info;

CREATE TABLE std_table (
    std_id INT PRIMARY KEY,
    std_name VARCHAR(50) NOT NULL,
    std_cgpa FLOAT4,
    std_age VARCHAR(30) NOT NULL
); 
insert into std_table(std_id,std_name, std_cgpa ,std_age)values ('22011417','moahmed sayed negm el din','2.69','second level');
insert into std_table(std_id,std_name, std_cgpa ,std_age)values ('2202129','marwan el sayed shawky','2.3','second level');
insert into std_table(std_id,std_name, std_cgpa ,std_age)values ('220','moahmed amgad','2.69','first level');

select * from std_table;

