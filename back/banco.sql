
CREATE TABLE dispositivos (
    id SERIAL PRIMARY KEY,
    nome TEXT NOT NULL,
    status BOOLEAN DEFAULT TRUE
);

CREATE TABLE avaliacoes (
    id SERIAL PRIMARY KEY,
    id_pergunta INTEGER REFERENCES perguntas(id) ON DELETE CASCADE,
    resposta INTEGER NOT NULL CHECK (resposta BETWEEN 0 AND 10),
    feedback TEXT,
    data_hora TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE perguntas (
    id SERIAL PRIMARY KEY,
    texto TEXT NOT NULL,
    status BOOLEAN DEFAULT TRUE,
    id_dispositivo INTEGER REFERENCES dispositivos(id) ON DELETE SET NULL
);


