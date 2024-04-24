-- Criar tabela Pessoa com chave primária auto-incrementada
CREATE TABLE Pessoa (
    Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100),
    Sexo CHAR(1),
    Email VARCHAR(100),
    Telefone VARCHAR(20),
    CEP CHAR(8),
    Logradouro VARCHAR(200),
    Cidade VARCHAR(100),
    Estado CHAR(2)
);

-- Criar tabela Paciente
CREATE TABLE Paciente (
    Peso DECIMAL(5,2),
    Altura DECIMAL(5,2),
    TipoSanguineo VARCHAR(5),
    Codigo INT PRIMARY KEY,
    FOREIGN KEY (Codigo) REFERENCES Pessoa(Codigo)
);

-- Criar tabela Funcionario
CREATE TABLE Funcionario (
    DataContrato DATE,
    Salario DECIMAL(10,2),
    SenhaHash VARCHAR(100),
    Codigo INT PRIMARY KEY,
    FOREIGN KEY (Codigo) REFERENCES Pessoa(Codigo)
);

-- Criar tabela Medico
CREATE TABLE Medico (
    Especialidade VARCHAR(100),
    CRM VARCHAR(20),
    Codigo INT PRIMARY KEY,
    FOREIGN KEY (Codigo) REFERENCES Funcionario(Codigo)
);

-- Criar tabela Agenda
CREATE TABLE Agenda (
    Codigo INT PRIMARY KEY,
    Data DATE,
    Horario TIME,
    Nome VARCHAR(100),
    Sexo CHAR(1),
    Email VARCHAR(100),
    CodigoMedico INT,
    FOREIGN KEY (CodigoMedico) REFERENCES Medico(Codigo)
);

-- Criar tabela BASE DE ENDERECOS AJAX
CREATE TABLE EnderecosAjax (
    CEP CHAR(8) PRIMARY KEY,
    Logradouro VARCHAR(200),
    Cidade VARCHAR(100),
    Estado CHAR(2)
);