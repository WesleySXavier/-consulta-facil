# -consulta-facil
Sistema de agendamento de consultas médicas - Projeto Integrador 

## 👥 Integrantes do Grupo
- Gustavo Pereira de Carvalho
- Matheus Ferreira da Cunha Fonseca
- Ruan Rodrigues Maciel da Cruz
- Sérgio Antônio Luiz Pessoa Christofo
- Wesley Souza Xavier

## 📋 Descrição
Sistema de agendamento de consultas médicas online, desenvolvido como prova de conceito para a segunda etapa do Projeto Integrador.

### Pré-requisitos
- Servidor web (XAMPP, WAMP, Laragon ou similar)
- PHP 8+
- MySQL


# Consulta Fácil - Prova de Conceito (PoC)

Projeto para entrega da 2ª etapa do Projeto Integrador - Curso TADS/TSI (SENAC)

## Estrutura
- `frontend/` - páginas estáticas (HTML, JS) para demonstrar fluxo de login, busca e agendamento.
- `backend/` - API PHP (api.php) e arquivo de configuração (config.php).
- `db/consulta_facil.sql` - script SQL para criar o banco e popular médicos de exemplo.

## Como rodar localmente (Windows - XAMPP / Laragon)
1. Copie a pasta `projeto-consulta-facil` para dentro da pasta `htdocs` (XAMPP) ou `www` (Laragon).
2. Abra o painel do XAMPP/Laragon e inicie Apache e MySQL.
3. Importar o script SQL:
   - Abra o `phpMyAdmin` (http://localhost/phpmyadmin) e execute o script `db/consulta_facil.sql` para criar o banco de dados `consulta_facil` e as tabelas.
4. Ajuste a conexão, se necessário:
   - Em `backend/config.php` configure `\$DB_USER` e `\$DB_PASS` conforme seu ambiente.
5. Acesse o frontend pelo navegador:
   - `http://localhost/projeto-consulta-facil/frontend/index.html`
6. Cadastro e login:
   - Use o formulário de cadastro para criar um usuário de teste (o script SQL não inclui usuários predefinidos).
   - Efetue login e teste a busca/agendamento.

## Observações de segurança (importante para entrega acadêmica)
- Este PoC armazena senha em texto simples para facilitar testes locais. **Em produção NUNCA** armazene senhas assim — utilize `password_hash()` e `password_verify()` no PHP.
- CORS está liberado no `api.php` por simplicidade; restrinja em ambientes reais.
- Não use este código em produção sem melhorias de segurança (proteção contra CSRF, autenticação JWT/sessões seguras, validação mais rígida).

## Sugestões de avaliação (para professor)
- Fluxo de uso: cadastro → login → busca por especialidade → agendamento.
- Testar conflitos de horário (o backend previne agendar o mesmo horário para o mesmo médico).
- Verificar o arquivo `db/consulta_facil.sql` (médicos de exemplo).

## Conteúdo 

### frontend/index.html
  ![link](https://github.com/WesleySXavier/-consulta-facil/blob/main/frontend/index.html)
### frontend/buscar.html
   ![link](https://github.com/WesleySXavier/-consulta-facil/blob/main/frontend/buscar.html)
### frontend/agendar.html
   ![link](https://github.com/WesleySXavier/-consulta-facil/blob/main/frontend/agendar.html)
### backend/home.html
  ![link](https://github.com/WesleySXavier/-consulta-facil/blob/main/projetointegrador/home.html)
### backend/config.php
  ![link](https://github.com/WesleySXavier/-consulta-facil/blob/main/backend/config.php)
### backend/api.php
  ![link](https://github.com/WesleySXavier/-consulta-facil/blob/main/backend/api.php)
### db/consulta_facil.sql
  ![link](https://github.com/WesleySXavier/-consulta-facil/tree/main/db)
### Relatório (Documento da 2ª etapa) incluído separadamente em Word.
  ![link](https://github.com/WesleySXavier/-consulta-facil/blob/main/Relatorio_2_Etapa_EXTENSO.docx)
### Video de apresentação
![link](https://youtu.be/Jy2HBViiwSw)


