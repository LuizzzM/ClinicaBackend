# Autores

- *Felipe Santos* ([GitHub](https://github.com/lsantosfelipe1))
- *Luiz Augusto*  ([GitHub](https://github.com/LuizzzM))
- *Caio César* ([GitHub](https://github.com/CaiaoCesar))

# Clinical Manager API

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## 📌 Requisitos Funcionais da API — Laboratório de Exames

### 🧑‍⚕️ 1. Gestão de Médicos
- Cadastrar novo médico
- Listar médicos existentes
- Editar dados de um médico
- Excluir médico

### 👤 2. Gestão de Clientes
- Cadastrar novo cliente
- Listar clientes
- Editar dados de um cliente
- Excluir cliente
- Visualizar histórico de exames e resultados de um cliente

### 🧪 3. Tipos de Exames
- Cadastrar tipos de exames disponíveis
- Listar todos os tipos de exames
- Editar tipo de exame
- Excluir tipo de exame

### 📅 4. Agendamento de Exames
- Cadastrar agendamento de exame
  - Deve especificar: cliente, exame, médico, data e horário
- Listar agendamentos
- Editar agendamento (ex: reagendar)
- Cancelar agendamento

### 📄 5. Resultados de Exames
- Cadastrar resultado de um exame realizado
- Visualizar resultados por cliente
- Editar resultado
- Excluir resultado (caso necessário)

### 🔒 6. Autenticação e Acesso
- Login para área administrativa (admin)
- Proteção de rotas com autenticação (JWT)

## 🛠 Tecnologias Utilizadas
- **Laravel 12**
- **Swagger**
- **JWT (JSON Web Token)**
- **SQLite**

## 🚀 Comandos para Instalação
1. Clone o repositório:
   ```bash
   git clone <>
   cd clinical-manager
   ```
2. Copie o arquivo de exemplo `.env`:
   ```bash
   cp .env.example .env
   ```
3. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```
4. Crie o link simbólico para o storage:
   ```bash
   php artisan storage:link
   ```
5. Execute as migrações e seeds:
   ```bash
   php artisan migrate --seed
   ```

## 📄 Documentação da API
Acesse a documentação da API gerada pelo Swagger em:
```
/api/documentation
```

## 👤 Usuário de Teste
- **Email:** test@example.com
- **Senha:** password

---

<p align="center">Desenvolvido com ❤️ usando Laravel 12</p>

