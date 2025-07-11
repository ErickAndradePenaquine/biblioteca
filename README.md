-------------------🎯 Tema do Projeto: Gestão de Biblioteca Comunitária---------------------

--------------------------------------------------------------------------------------------

# Você vai desenvolver um sistema web para gerenciar os empréstimos de livros feitos por uma biblioteca comunitária: 
  - Os livros têm número limitado de cópias; 
  - Os leitores só podem pegar até 3 livros por vez; 
  - O sistema também deve calcular e indicar atrasos na devolução.

--------------------------------------------------------------------------------------------

📘 Tabelas e Funcionalidades (CRUD)

-- 1. Livros (books)
Campos = [id, titulo, autor, genero, ano_publicacao, quantidade_total]

Funcionalidades = CRUD completo e Validação para quantidade_total >= 0.

-- 2. Leitores (readers)
Campos = [id, nome, cpf, email, telefone]

Funcionalidades = CRUD completo; CPF único (validação); Formato do e-mail válido.

-- 3. Empréstimos (loans)
Campos = [id, reader_id, book_id, data_emprestimo, data_prevista_devolucao, data_devolucao, status]

Funcionalidades = 

# Criar empréstimo:
Só permitir se o livro tiver cópias disponíveis;
Só permitir se o leitor tiver menos de 3 livros em aberto.

Atualizar devolução:
Registrar data_devolucao e mudar status para "Devolvido";
Calcular se houve atraso e indicar em vermelho;
Exibir livros emprestados por leitor;
Exibir alertas de livros em atraso.

--------------------------------------------------------------------------------------------

🧠 Regras de Negócio (importantes):

1.Livro só pode ser emprestado se houver cópias disponíveis.
2.Leitor só pode ter até 3 empréstimos ativos.
3.A devolução atrasada deve exibir um alerta.
4.O sistema deve calcular o número de cópias disponíveis a partir de quantidade_total - empréstimos_ativos.

--------------------------------------------------------------------------------------------

📄 Página inicial (dashboard), Páginas do Sistema (mínimo 6):

1.Listagem de livros com opções de cadastro, edição e exclusão
2.Listagem de leitores com CRUD
3.Empréstimos: formulário para registrar empréstimos
4.Devoluções: listar empréstimos em aberto e permitir marcar devolução
5.Relatório: lista de empréstimos em atraso e status por leitor

--------------------------------------------------------------------------------------------

🛠️ Extras opcionais (se quiser ir além)

1.Autenticação com login de administrador
2.Exportar relatório em PDF dos livros em atraso
3.Filtrar empréstimos por período
4.Campo de busca por título ou CPF

--------------------------------------------------------------------------------------------

🧰 Ferramentas que você está usando:

1.Framework: Laravel
2.Banco de Dados: MySQL via XAMPP (com phpMyAdmin)
3.Frontend: Blade (telas padrão do Laravel)

--------------------------------------------------------------------------------------------



### RESOLUÇÃO

# BANCO DE DADOS, CRIANDO AS TRES TABLES: 

    CREATE TABLE livros (
        id INT AUTO_INCREMENT PRIMARY KEY, 
        titulo VARCHAR(50), 
        autor VARCHAR(50), 
        genero VARCHAR(50), 
        ano_publicacao VARCHAR(10), 
        quantidade_total INT CHECK (quantidade_total >= 0),
        created_at TIMESTAMP NULL DEFAULT NULL,
        updated_at TIMESTAMP NULL DEFAULT NULL
        );

    CREATE TABLE leitor (
        id INT AUTO_INCREMENT PRIMARY KEY, 
        nome VARCHAR(100), 
        cpf VARCHAR(15) UNIQUE, 
        email VARCHAR(50), 
        telefone VARCHAR(20),
        created_at TIMESTAMP NULL DEFAULT NULL,
        updated_at TIMESTAMP NULL DEFAULT NULL
    );

    CREATE TABLE emprestimo (
        id INT AUTO_INCREMENT PRIMARY KEY, 
        leitor_id INT, 
        livro_id INT, 
        data_emprestimo DATE, 
        data_prevista_devolucao DATE NULL, 
        data_devolucao DATE, 
        status VARCHAR(20) CHECK (status IN ('Ativo', 'Devolvido', 'Atrasado')), 
        created_at TIMESTAMP NULL DEFAULT NULL,
        updated_at TIMESTAMP NULL DEFAULT NULL,
        FOREIGN KEY (leitor_id) REFERENCES leitor(id), 
        FOREIGN KEY (livro_id) REFERENCES livros(id)
    );

    CREATE INDEX idx_emprestimo_leitor ON emprestimo(leitor_id);
    CREATE INDEX idx_emprestimo_livro ON emprestimo(livro_id);
    CREATE INDEX idx_emprestimo_status ON emprestimo(status);

# MODELS:

    App\Models\LivrosModel.php
    App\Models\LeitorModel.php
    App\Models\EmprestimoModel.php

# ROTAS:
    Routes/web.php:
      Exemplo de rota: Route::get('/dashboard', [Controller::class, 'index']);

        /dashboard (rota main)

        -- LIVROS
        /formcreatelivros
        /createlivros
        /formupdatelivros/{id}
        /updatelivros
        /deletelivro/{id}

        -- LEITOR
        /listleitor
        /formcreateleitor
        /createleitor
        /formupdateleitor
        /updateleitor
        /deleteleitor

        -- EMPRESTIMO
        /listaremprestimo
        /formupdatelivros/{id}
        /createmprestimo
        /formupdateemprestimo/{id}
        /updatemprestimo/{id}

# CONTROLLERS:
    Funções:
       
        -- LIVROS
            1. index
            2. formcreate
            3. store
            4. formupdate
            5. update
            6. destroy
            (talves criar a show)

        -- LEITOR
            1. index
            2. formcreate
            3. store
            4. formupdate
            5. update
            6. destroy
            (talves criar a show)

        -- EMPRESTIMO
            1. index
            2. formcreate
            3. store
            4. formupdate
            5. update
            (talves criar a show)


# VIEWS BLADE:

    resources/views/
    │
    ├── layouts/
    │   └── header.blade.php
    │
    ├── leitor/
    │   └── listLeitor.blade.php
    │   └── createLeitor.blade.php
    │   └── updateLeitor.blade.php
    │
    ├── livros/
    │   └── createLivros.blade.php
    │   └── updateLivros.blade.php
    │
    ├── emprestimo/
    │   └── listEmprestimo.blade.php
    │   └── createEmprestimo.blade.php
    │   └── updateEmprestimo.blade.php
    │
    └── dashboard.blade.php







