using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace pregunta3__324
{
    public partial class WebForm1 : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (Session["UserId"] != null)
            {
                Response.Redirect("cuentas.aspx");
            }
        }
        protected void IniciarSesion(object sender, EventArgs e)
        {
            if (string.IsNullOrWhiteSpace(txtUsuario.Text) || string.IsNullOrWhiteSpace(txtContrasenia.Text))
            {
                mensajeadv.Text = "Todos los campos son obligatorios. Por favor, ingresa tu usuario y contraseña.";
                return;
            }
            string usuario = txtUsuario.Text;
            string contrasenia = txtContrasenia.Text;
            string connectionString = @"server=DESKTOP-4NU7F5H;database=bdmireyaconsuelomamanicarita;user=mizmi;pwd=12345";
            SqlConnection con = new SqlConnection(connectionString);
            con.Open();
            string sql = "SELECT id,nombre FROM usuario WHERE telefono = @usuario AND pwd = @contrasenia";
            SqlDataAdapter ada = new SqlDataAdapter(sql, con);
            ada.SelectCommand.Parameters.AddWithValue("@usuario", usuario);
            ada.SelectCommand.Parameters.AddWithValue("@contrasenia", contrasenia);
            DataSet ds = new DataSet();
            ada.Fill(ds, "Usuario");
            DataTable dt = ds.Tables["Usuario"];
            if (dt.Rows.Count > 0)
            {
                DataRow row = dt.Rows[0]; 
                int userId =(int)row["id"];
                string nomb=row["nombre"].ToString();
                Session["UserId"] = userId;
                Session["NomeUs"] = nomb;
                Response.Redirect("cuentas.aspx");
            }
            else
                {
                    mensajeadv.Text = "Usuario o contraseña incorrectos. Por favor, intenta nuevamente.";
                }
            con.Close();
        }
    }
}