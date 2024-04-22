<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="inicio.aspx.cs" Inherits="pregunta3__324.WebForm1" %>


<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<link rel="stylesheet" href="estilos.css"/>  
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>

    <title>iniciar sesion</title>
</head>
<body>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">Iniciar sesión</div>
                <div class="card-body">
                    <asp:Literal runat="server" ID="mensajeadv" />
                    <form id="formLogin" runat="server">
                        <div class="form-group">
                            <label for="usuario">Usuario (teléfono):</label>
                            <asp:TextBox runat="server" ID="txtUsuario" CssClass="form-control" placeholder="Escribe el usuario" />
                        </div>
                        <div class="form-group">
                            <label for="contrasenia">Contraseña:</label>
                            <asp:TextBox runat="server" ID="txtContrasenia" CssClass="form-control" TextMode="Password" placeholder="Escribe la contraseña" />
                        </div>
                        <asp:Button runat="server" Text="Ingresar" CssClass="btn btn-primary" OnClick="IniciarSesion" />
                        <a class="btn btn-primary" href="registro.aspx">Registro</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
