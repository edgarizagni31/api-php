
CREATE TABLE cita (
    id int(11) AUTO_INCREMENT,
    mascot	varchar(100) NOT NULL,
    owner varchar(100) NOT NULL,
    phone varchar(9) NOT NULL,
    date date NOT NULL,
    time time NOT NULL,
    symptom	varchar(100) NOT NULL,
    PRIMARY KEY(id)
)