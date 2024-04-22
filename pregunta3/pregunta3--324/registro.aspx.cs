using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

namespace pregunta3__324
{
    public partial class registro : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            if (Session["UserId"] != null)
            {
                Response.Redirect("cuentas.aspx");
            }
        }
        protected void Registrarusuario(object sender, EventArgs e) {
            string nombre = txtnombre.Text;
            string ci = txtci.Text;
            DateTime fechaNac = DateTime.Parse(txtfecha.Text);
            string telefono = txttelefono.Text;
            string password = txtpwd.Text;
            DateTime fechaActual = DateTime.Now;
            int edad =  fechaActual.Year-fechaNac.Year ;
            if (fechaActual.Month < fechaNac.Month ||
                (fechaActual.Month == fechaNac.Month && fechaActual.Day < fechaNac.Day))
            {
                edad--;
            }
            if (edad >= 18)
            {
                string connectionString = @"server=DESKTOP-4NU7F5H;database=bdmireyaconsuelomamanicarita;user=mizmi;pwd=12345";
                SqlConnection con = new SqlConnection(connectionString);
                con.Open();
                if (!UsuarioExiste(nombre, ci, telefono))
                {
                    SqlCommand cmd = new SqlCommand("INSERT INTO usuario (nombre, ci, fecha, telefono, pwd) VALUES (@nombre, @ci, @fecha, @telefono, @pwd)", con);
                    cmd.Parameters.AddWithValue("@nombre", nombre);
                    cmd.Parameters.AddWithValue("@ci", ci);
                    cmd.Parameters.AddWithValue("@fecha", fechaNac);
                    cmd.Parameters.AddWithValue("@telefono", telefono);
                    cmd.Parameters.AddWithValue("@pwd", password);
                    cmd.ExecuteNonQuery();
                    Response.Redirect("inicio.aspx");
                }
                else 
                {
                    mensajeadv.Text = "El usuario ya existe";
                    return;
                }

                con.Close();
            }
            else 
            {
                mensajeadv.Text = "Lo siento, debes ser mayor de edad para crear una cuenta."+edad+" "+fechaActual+" "+fechaNac;
                return;
            }
            
            
            bool UsuarioExiste(string nomv, string civ,string telfv)
            {
                string connectionString = @"server=DESKTOP-4NU7F5H;database=bdmireyaconsuelomamanicarita;user=mizmi;pwd=12345";
                SqlConnection con = new SqlConnection(connectionString);
                con.Open();

                    string sqlVerificar = "SELECT COUNT(*) FROM usuario WHERE nombre = @nombre OR ci = @ci OR telefono = @telefono";
                    SqlCommand cmdVerificar = new SqlCommand(sqlVerificar, con);
                    cmdVerificar.Parameters.AddWithValue("@nombre", nomv);
                    cmdVerificar.Parameters.AddWithValue("@ci", civ);
                    cmdVerificar.Parameters.AddWithValue("@telefono", telfv);
                    int count = (int)cmdVerificar.ExecuteScalar();
                    return count > 0;
                
            }
        }
    }
}