<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="registro.aspx.cs" Inherits="pregunta3__324.registro" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="estilos.css"/>  
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <title>Registro usuario</title>
</head>
<body>
  <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">Registro Usuario</div>
                    <div class="card-body">
                        <asp:Literal runat="server" ID="mensajeadv" />
                        <form id="registroForm" runat="server">
                            <div class="form-group">
                                  <label for="nombre">Nombre:</label><br/>
                                <asp:TextBox runat="server" ID="txtnombre" CssClass="form-control" placeholder="Escribe tu nombre" required="true"></asp:TextBox>
                            </div>
                            <div class="form-group">
                                  <label for="ci">CI:</label><br/>
                                <asp:TextBox runat="server" ID="txtci" CssClass="form-control" placeholder="CI" required="true"></asp:TextBox>
                            </div>
                            <div class="form-group">
                                  <label for="fecha">Fecha Nacimiento:</label><br/>
                                <asp:TextBox runat="server" ID="txtfecha" CssClass="form-control" TextMode="Date" placeholder="Fecha de nacimiento" required="true"></asp:TextBox>
                            </div>
                            <div class="form-group">
                                  <label for="telefono">Teléfono:</label><br/>
                                <asp:TextBox runat="server" ID="txttelefono" CssClass="form-control" placeholder="Teléfono" required="true"></asp:TextBox>
                            </div>
                            <div class="form-group">
                                  <label for="pwd">Contraseña:</label><br/>
                                <asp:TextBox runat="server" ID="txtpwd" CssClass="form-control" TextMode="Password" placeholder="Contraseña" required="true"></asp:TextBox>
                                </div>
                             <asp:Button runat="server" Text="Registrar" CssClass="btn btn-primary" OnClick="Registrarusuario" />
                             <a class="btn btn-primary" href="inicio.aspx">Cancelar</a>
                        </form>
                    </div>
                </div>
         </div>
     </div>
   </div>
</body>
</html>
