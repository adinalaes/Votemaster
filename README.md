Votemaster
Instructions
To run this project locally, you need an Apache server (e.g., XAMPP for Windows or Docker) capable of running PHP.

Place the contents of this repository into the htdocs or www directory, depending on your setup.

Start the server.

For maximum portability and compatibility, the database is external.
To make the application work, I need to manually add your server's IP address as an allowed host for accessing the MySQL database (hosted externally).
This is a standard approach, as the database server is meant to stay in a fixed location.

Alternatively, you can modify backend/connect.php to connect to a different MySQL database.
If needed, I can provide an export of the database so you can host it wherever you prefer.