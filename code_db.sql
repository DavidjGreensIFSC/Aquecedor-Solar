CREATE DATABASE AQS_db;
USE AQS_db;

-- 1. Tabela para identificar a placa ESP que está enviando os dados
CREATE TABLE dispositivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,          -- Ex: 'ESP-Boiler-Principal'
    mac_placa CHAR(17) UNIQUE NOT NULL, -- Endereço MAC do ESP
    ativo BOOLEAN DEFAULT TRUE
);

-- 2. Tabela de Leituras (Onde a mágica acontece)
-- O ESP vai mandar um único POST com as duas temperaturas
CREATE TABLE leituras (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    dispositivo_id INT,
    
    -- Temperaturas
    temp_entrada_fria DECIMAL(5,2) NOT NULL,
    temp_saida_quente DECIMAL(5,2) NOT NULL,
    
    -- Campo calculado automaticamente (Diferencial térmico)
    -- Facilita saber quanto a água esquentou sem precisar fazer conta no Dashboard
    diferencial_termico DECIMAL(5,2) AS (temp_saida_quente - temp_entrada_fria) STORED,
    
    -- Registro de tempo (Ano, Mês, Dia, Hora, Minuto, Segundo)
    data_leitura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Status do ESP (pode enviar 1 para OK, ou códigos de erro caso o sensor desconecte)
    status_sistema TINYINT(1) DEFAULT 1,
    
    FOREIGN KEY (dispositivo_id) REFERENCES dispositivos(id),
    
    -- Índice crucial para o Dashboard carregar rápido
    INDEX idx_data (data_leitura)
);

-- ==========================================================
-- POPULANDO DADOS INICIAIS (EXEMPLO)
-- ==========================================================

-- Cadastrando o ESP (Troque pelo MAC real do seu ESP)
INSERT INTO dispositivos (nome, mac_placa) VALUES ('Aquecedor IFSC', 'AA:BB:CC:DD:EE:FF');

-- Exemplo de como o seu script vai inserir os dados recebidos do ESP:
-- INSERT INTO leituras (dispositivo_id, temp_entrada_fria, temp_saida_quente) VALUES (1, 22.50, 58.30);