<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Paciente;
use Illuminate\Http\File;
use App\Especialidade;

class TestController extends Controller
{
    public function index()
    {
      /**
     $cbos = ['201115'=>'Geneticista',
            '203015' => 'Pesquisador em Biologia de Micro-organismos e Parasitas',
            '213150' => 'Físico Médico',
            '221105' => 'Biólogo',
            '223204' => 'Cirurgião Dentista - Auditor',
            '223208' => 'Cirurgião Dentista - Clínico Geral',
            '223212' => 'Cirurgião Dentista - Endodontista',
            '223216' => 'Cirurgião Dentista - Epidemiologista',
            '223220' => 'Cirurgião Dentista - Estomatologista',
            '223224' => 'Cirurgião Dentista - Implantodontista',
            '223228' => 'Cirurgião Dentista - Odontogeriatra',
            '223232' => 'Cirurgião Dentista - Odontologista Legal',
            '223236' => 'Cirurgião Dentista - Odontopediatra',
            '223240' => 'Cirurgião Dentista - Ortopedista E Ortodontista',
            '223244' => 'Cirurgião Dentista - Patologista Bucal',
            '223248' => 'Cirurgião Dentista - Periodontista',
            '223252' => 'Cirurgião Dentista - Protesiólogo Bucomaxilofacial',
            '223256' => 'Cirurgião Dentista - Protesista',
            '223260' => 'Cirurgião Dentista - Radiologista',
            '223264' => 'Cirurgião Dentista - Reabilitador Oral',
            '223268' => 'Cirurgião Dentista - Traumatologista Bucomaxilofacial',
            '223272' => 'Cirurgião Dentista de Saúde Coletiva',
            '223276' => 'Cirurgião Dentista – Odontologia do Trabalho',
            '223280' => 'Cirurgião Dentista - Dentística',
            '223284' => 'Cirurgião Dentista - Disfunção Temporomandibular e Dor Orofacial',
            '223288' => 'Cirurgião Dentista - Odontologia para Pacientes com Necessidades Especiais',
            '223293' => 'Cirurgião-Dentista da Estratégia de Saúde da Família',
            '223505' => 'Enfermeiro ',
            '223605' => 'Fisioterapeuta Geral',
            '223710' => 'Nutricionista',
            '223810' => 'Fonoaudiólogo',
            '223905' => 'Terapeuta Ocupacional',
            '223910' => 'Ortoptista',
            '225103' => 'Médico Infectologista',
            '225105' => 'Médico Acupunturista',
            '225106' => 'Médico Legista',
            '225109' => 'Médico Nefrologista',
            '225110' => 'Médico Alergista e Imunologista',
            '225112' => 'Médico Neurologista',
            '225115' => 'Médico Angiologista',
            '225118' => 'Médico Nutrologista',
            '225120' => 'Médico Cardiologista',
            '225121' => 'Médico Oncologista Clínico',
            '225122' => 'Médico Cancerologista Pediátrico',
            '225124' => 'Médico Pediatra',
            '225125' => 'Médico Clínico',
            '225127' => 'Médico Pneumologista',
            '225130' => 'Médico de Família e Comunidade',
            '225133' => 'Médico Psiquiatra',
            '225135' => 'Médico Dermatologista',
            '225136' => 'Médico Reumatologista',
            '225139' => 'Médico Sanitarista',
            '225140' => 'Médico do Trabalho',
            '225142' => 'Médico da Estratégia de Saúde da Família',
            '225145' => 'Médico em Medicina de Tráfego',
            '225148' => 'Médico Anatomopatologista',
            '225150' => 'Médico em Medicina Intensiva',
            '225151' => 'Médico Anestesiologista',
            '225155' => 'Médico Endocrinologista e Metabologista',
            '225160' => 'Médico Fisiatra',
            '225165' => 'Médico Gastroenterologista',
            '225170' => 'Médico Generalista',
            '225175' => 'Médico Geneticista',
            '225180' => 'Médico Geriatra',
            '225185' => 'Médico Hematologista',
            '225195' => 'Médico Homeopata',
            '225203' => 'Médico em Cirurgia Vascular',
            '225210' => 'Médico Cirurgião Cardiovascular',
            '225215' => 'Médico Cirurgião de Cabeça e Pescoço',
            '225220' => 'Médico Cirurgião do Aparelho Digestivo',
            '225225' => 'Médico Cirurgião Geral',
            '225230' => 'Médico Cirurgião Pediátrico',
            '225235' => 'Médico Cirurgião Plástico',
            '225240' => 'Médico Cirurgião Torácico',
            '225250' => 'Médico Ginecologista e Obstetra',
            '225255' => 'Médico Mastologista',
            '225260' => 'Médico Neurocirurgião',
            '225265' => 'Médico Oftalmologista',
            '225270' => 'Médico Ortopedista e Traumatologista',
            '225275' => 'Médico Otorrinolaringologista',
            '225280' => 'Médico Proctologista',
            '225285' => 'Médico Urologista',
            '225290' => 'Médico Cancerologista Cirúrgico',
            '225295' => 'Médico Cirurgião da Mão',
            '225305' => 'Médico Citopatologista',
            '225310' => 'Médico em Endoscopia',
            '225315' => 'Médico em Medicina Nuclear',
            '225320' => 'Médico em Radiologia e Diagnóstico por Imagem',
            '225325' => 'Médico Patologista',
            '225330' => 'Médico Radioterapeuta',
            '225335' => 'Médico Patologista Clínico / Medicina Laboratorial',
            '225340' => 'Médico Hemoterapeuta',
            '225345' => 'Médico Hiperbarista',
            '225350' => 'Médico Neurofisiologista',
            '239425' => 'Psicopedagogo',
            '251510' => 'Psicólogo Clínico',
            '251545' => 'Neuropsicólogo',
            '251550' => 'Psicanalista',
            '251605' => 'Assistente Social',
            '322205' => 'Técnico de Enfermagem',
            '322220' => 'Técnico de Enfermagem Psiquiátrica',
            '322225' => 'Instrumentador Cirúrgico',
            '322230' => 'Auxiliar de Enfermagem',
            '516210' => 'Cuidador de Idosos',
            '999999' => 'CBO Desconhecido ou não Informado pelo Solicitante'];

    foreach ($cbos as $key => $value) {
      $k = intval($key);
      DB::select(DB::raw("insert into especialidades(nome, cbo) values ('$value', '$k')"));
    }

      return response()->json(200);
      //return view('test.test', compact('cbo'));**/
    }
}
