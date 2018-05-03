<?php

namespace app\controllers\admin;


use app\controllers\basecontroller;
use app\models\docente;
use app\models\carrera;
use app\models\asignatura;
use app\models\alumno;
use app\models\asignatura_seccion;
use app\models\sede;
use Sirius\Validation\Validator;

class academicocontroller extends basecontroller
{
    public function getIndex()
    {
        if (isset($_SESSION['userId']))
        {
            $userId=$_SESSION['userId'];
            $docente=docente::find($userId);

            if($docente)
            {
                return $this->render('admin/index.twig', ['docente'=>$docente]);
            }
        }

        header('Location:' . BASE_URL . 'auth/login');

    }

    public function getRegistro_manual()
    {
        $carrera=carrera::all();
        $asignatura=asignatura::all();
        $sede=sede::all();

        return $this->render('admin/registro_manual_alumno.twig',[
            'carrera'=>$carrera,
            'asignatura'=>$asignatura,
            'sede'=>$sede
        ]);
    }

    public function postRegistro_manual()
    {

        $errors=[];
        $result=false;
        $validator=new Validator();
        $validator->add('sede','required');
        $validator->add('carrera','required');
        $validator->add('matricula','required');
        $validator->add('nombre','required');
        $validator->add('email','required');
        $validator->add('email','email');

        if ($validator->validate($_POST))
        {
            $alumno=new alumno();
            $alumno->id=$_POST['matricula'];
            $alumno->carrera_id=$_POST['carrera'];
            $alumno->sede_id=$_POST['sede'];
            $alumno->nombre=$_POST['nombre'];
            $alumno->correo=$_POST['email'];
            $alumno->password=password_hash($_POST['matricula'], PASSWORD_DEFAULT);
            $alumno->save();
            $result=true;
        }else{
            $errors=$validator->getMessages();
        }

        $carrera=carrera::all();
        $sede=sede::all();

        return $this->render('admin/registro_manual_alumno.twig',[
            'result'=>$result,
            'errors'=>$errors,
            'carrera'=>$carrera,
            'sede'=>$sede
        ]);
    }

    public function getRamos()
    {

        $carrera=carrera::all();
        $asignatura=asignatura::all();
        $docente=docente::select('id','nombre')->get();


        return $this->render('admin/registro_ramo-docente.twig',[
            'carrera'=>$carrera,
            'asignatura'=>$asignatura,
            'docente'=>$docente
        ]);
    }

    public function postRamos()
    {
        $errors=[];
        $result=false;
        $validator=new Validator();
        $validator->add('seccion','required');
        $validator->add('docente','required');
        $validator->add('carrera','required');
        $validator->add('asignatura','required');
        $mes=date('m');
        if ($mes>=01 && $mes<=07){
            $semestre=1;
        }elseif ($mes>=8 && $mes<=12)
        {
            $semestre=2;
        }


        if ($validator->validate($_POST))
        {
            $asig_sec=new asignatura_seccion();
            $asig_sec->year=date('Y');
            $asig_sec->semestre=$semestre;
            $asig_sec->num_seccion=$_POST['seccion'];
            $asig_sec->asignatura_id=$_POST['asignatura'];
            $asig_sec->carrera_id=$_POST['carrera'];
            $asig_sec->docente_rut=$_POST['docente'];
            $asig_sec->save();
            $result=true;
        }else{
            $errors=$validator->getMessages();
        }

        $carrera=carrera::all();
        $asignatura=asignatura::all();
        $docente=docente::select('id','nombre')->get();


        return $this->render('admin/registro_ramo-docente.twig',[
            'result'=>$result,
            'errors'=>$errors,
            'carrera'=>$carrera,
            'asignatura'=>$asignatura,
            'docente'=>$docente
        ]);
    }

    public function getRegistro_masivo()
    {
        $carrera=carrera::all();
        $sede=sede::all();

        return $this->render('admin/registro_masivo_alumno.twig',[
            'carrera'=>$carrera,
            'sede'=>$sede
        ]);
    }

    public function postRegistro_masivo()
    {

    }

}