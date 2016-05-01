<?php
class Empleado
{

	private $legajo;
	private $nombre;
	private $apellido;
	private $sexo;
    private $pathFoto;



	public function  GetLegajo()
	{

		return $this->legajo;
	}
    public function  GetNombre()
	{

		return $this->nombre;
	}
	public function  GetApellido()
	{

		return $this->apellido;
	}
	public function  GetSexo()
	{

		return $this->sexo;
	}
	public function  GetFoto()
	{

		return $this->pathFoto;
	}
     public function  SetLegajo($legajo)
	{

		$this->legajo=$legajo;
	}
    public function  SetNombre($nombre)
	{

	 $this->nombre= $nombre;
	}
	public function  SetApellido($apellido)
	{

		$this->apellido= $apellido;
	}
	public function  SetSexo($sexo)
	{

	 $this->sexo= $sexo;
	}
	public function  SetFoto($foto)
	{

		$this->pathFoto=$foto;
	}

    
public function __construct($legajo=NULL,$nombre=NULL,$apellido=NULL,$sexo=NULL, $pathFoto=NULL)
	{
		if($legajo!== NULL && $nombre !== NULL && $apellido !== NULL && $sexo !== NULL){
			$this->legajo = $legajo;
			$this->nombre = $nombre;
			$this->apellido=$apellido;
			$this->sexo=$sexo;
			$this->pathFoto = $pathFoto;
		}
	}

	public function ToString()
	{

		return $this->legajo." , ".$this->nombre." , ".$this->apellido." , ".$this->sexo." , ".$this->pathFoto."\r\n";
    }
    
    public static function Guardar($obj)
    {
    	$res=false;

    	$archivo= fopen("archivos/empleados.txt", "a");

    	$cant=fwrite($archivo, $obj->ToString());

    	if($cant >0)
    {
    	$res= true;

    }
    fclose($archivo);
    return $res;
    }

    public static function TraerTodosLosEmpleados()
    {
    	$ListaEmpleadosLeidos= array();

    	$archivo= fopen("archivos/empleados.txt", "r");

    	while (!feof($archivo)) 
    	{
    		$arcAux= fgets($archivo);
    		$empleados =explode(" , ", $arcAux );

    		$empleados[0]= trim($empleados[0]);
    		if($empleados[0]!= "")
    		{
    			$ListaEmpleadosLeidos[]=new Empleado($empleados[0],$empleados[1],$empleados[2],$empleados[3],$empleados[4]);
    		} 
    	}
    	fclose($archivo);
    	return $ListaEmpleadosLeidos;
    }

    public static function Modificar($obj)
    {
    	$res= true;

    	$ListaEmpleadosLeidos= Empleado::TraerTodosLosEmpleados();
    	$ListaEmpleados=array();
    	$imagenParaBorrar=NULL;

    	for ($i=0; $i<count($ListaEmpleadosLeidos) ; $i++) 
    	{ 
    		if( $ListaEmpleadosLeidos[$i]->legajo== $obj->legajo)
    		{
    			$imagenParaBorrar= trim($ListaEmpleadosLeidos[$i]->pathFoto);
    			continue;
    		}
    		$ListaEmpleados[$i]= $ListaEmpleadosLeidos[$i];
    	}
    	array_push($ListaEmpleados,$obj);

    	unlink("archivos/".$imagenParaBorrar);
         $archivo= fopen("archivos/empleados.txt", "w");

         foreach ($ListaEmpleados as  $item) {

         	$escribir= fwrite($archivo, $item->ToString());
         	if($escribir < 1)
         	{
         		$res=false;
         		break;
         	}
         }
             fclose($archivo);
             return $res;
    }
    public static function Eliminar($legajo)
    {
    	if($legajo === NULL)
			return FALSE;
			
		$res = TRUE;
		
		$ListaDeEmpleadosLeidos = Empleado::TraerTodosLosEmpleados();
		$ListaDeEmpleados = array();
		$imagenParaBorrar = NULL;
		
		for($i=0; $i<count($ListaDeEmpleadosLeidos); $i++){
			if($ListaDeEmpleadosLeidos[$i]->legajo == $legajo){//encontre el borrado, lo excluyo
				$imagenParaBorrar = trim($ListaDeEmpleadosLeidos[$i]->pathFoto);
				continue;
			}
			$ListaDeEmpleados[$i] = $ListaDeEmpleadosLeidos[$i];
		}

		//BORRO LA IMAGEN ANTERIOR
		unlink("archivos/".$imagenParaBorrar);
		
		//ABRO EL ARCHIVO
		$archivo = fopen("archivos/empleados.txt", "w");
		
		//ESCRIBO EN EL ARCHIVO
		foreach($ListaDeEmpleados AS $item){
			$cant = fwrite($archivo, $item->ToString());
			
			if($cant < 1)
			{
				$res = FALSE;
				break;
			}
		}
		
		//CIERRO EL ARCHIVO
		fclose($archivo);
		
		return $res;
	}

    
}

?>
