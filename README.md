Projeto
 Um sistema de crud completo de cadastrado de produtos e usúarios.
 O projeto e divido em  bancked e frontend, com laravel versão 6.0 no backend api
 restful, e no frontend angular versao 9.0.


 ======================================BACKEND==========================================
 
 //setup
 1- php artisan serve
 2- php artisan 
 3- php artisan migrate 
 4- php artisan migrate seed


Rotas:
 // Grupo de rota para Usuario

	 //Lista Todos os usuarios 
	 Verbo get
	 http://127.0.0.1:8000/api/users/

	 //Busca usuario por ID somente numero inteiro
	 Verbo get
	 http://127.0.0.1:8000/api/users/3

	 //Criar novo usuario
	 Verbo post
	 http://127.0.0.1:8000/api/users/
	 campo name obrigatorio
	 campo email obrigatorio
	 campo password obrigatorio
	 campo permision

	 //Atualizar usuario por ID  somente numero inteiro
	 Verbo put
	 http://127.0.0.1:8000/api/users/3
	 campo name 
	 campo email 
	 campo password 
	 campo permission


	 //Remover usúario por ID  somente numero inteiro
	 Verbo delete
	 http://127.0.0.1:8000/api/users/3

	 //Login usúario
	 Verbo post 
	 http://127.0.0.1:8000/api/users/login

	 

 Rotas:
 // Grupo de rota para produtos 

	 //Lista Todos os produtos 
	 Verbo get
	 http://127.0.0.1:8000/api/products/

	 //Busca produto por ID somente numero inteiro
	 Verbo get
	 http://127.0.0.1:8000/api/products/7

	 //Criar novo produto 
	 Verbo post
	 http://127.0.0.1:8000/api/products/
	 campo name obrigatorio
	 campo price obrigatorio
	 campo description obrigatorio

	 //Atualizar produto por ID  somente numero inteiro
	 Verbo put
	 http://127.0.0.1:8000/api/products/
	 campo name 
	 campo price 
	 campo description 


	 //Remover produto por ID  somente numero inteiro
	 Verbo delete
	 http://127.0.0.1:8000/api/products/7
	 

=>Erros do sistema interno
	Diretorio: app/Help/ApError.php
	A classe recebe uma mensagem e um codigo para o error interno.
=>






 ======================================fRONTEND========================================


//Setup
1- ng serve


Rotas: