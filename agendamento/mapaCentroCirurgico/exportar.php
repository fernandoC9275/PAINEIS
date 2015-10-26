<?php
//Conexão
include_once('../../../oracle/connec.php');

// Incluimos a classe PHPExcel
include  '../../classes/PHPExcel.php';

$data = $_POST['data'];
$nome_arquivo  = str_replace('/', '_',$data);


if(isset($data)) {
    $query_cirurgias_dia = "SELECT AGE_CIR . CD_AGE_CIR CD_AGE_CIR,
       TRUNC(AGE_CIR . DT_INICIO_AGE_CIR) DT_INICIO_AGE_CIR,
       TO_CHAR(AGE_CIR . DT_INICIO_AGE_CIR, 'HH24:MI') HR_INICIO_AGE_CIR,
       AVISO_CIRURGIA . CD_AVISO_CIRURGIA CD_AVISO_CIRURGIA,
       AVISO_CIRURGIA . NR_TELEFONE_CONTATO NR_TELEFONE_CONTATO,
       ATENDIME . CD_ATENDIMENTO CD_ATENDIMENTO,
       FN_CSSJ_CIRURGIA_DET_CONVENIO(AVISO_CIRURGIA.CD_AVISO_CIRURGIA) CONVENIO,
       FN_CSSJ_CIRURGIA_DET_OBS(AVISO_CIRURGIA.CD_AVISO_CIRURGIA) OBS_CIR,
       FN_CSSJ_CIRURGIA_DET_DESCRICAO(AVISO_CIRURGIA.CD_AVISO_CIRURGIA) DS_CIRURGIA,
       SAL_CIR . CD_SAL_CIR CD_SAL_CIR,
       SAL_CIR . DS_SAL_CIR DS_SAL_CIR,
       SAL_CIR . DS_RESUMIDA DS_RESUMIDA,
       CEN_CIR . CD_CEN_CIR CD_CEN_CIR,
       CEN_CIR . DS_CEN_CIR DS_CEN_CIR,
       FN_CSSJ_CIRURGIA_AUXILIAR2(AVISO_CIRURGIA.CD_AVISO_CIRURGIA) AUXILIAR2,
       FN_CSSJ_CIRURGIA_AUXILIAR1(AVISO_CIRURGIA.CD_AVISO_CIRURGIA) AUXILIAR1,
       FN_CSSJ_CIRURGIA_CIRURGIAO(AVISO_CIRURGIA.CD_AVISO_CIRURGIA) CIRURGIAO,
       FN_CSSJ_CIRURGIA_ANESTESISTA(AVISO_CIRURGIA.CD_AVISO_CIRURGIA) ANESTESISTA,
       NVL(PACIENTE . CD_PACIENTE, AVISO_CIRURGIA . CD_PACIENTE) CD_PACIENTE,
       NVL(PACIENTE . NM_PACIENTE, AVISO_CIRURGIA . NM_PACIENTE) NM_PACIENTE,
       CONVENIO . CD_CONVENIO CD_CONVENIO,
       CONVENIO . NM_CONVENIO NM_CONVENIO,
       LEITO . DS_RESUMO DS_LEITO,
       DECODE(AVISO_CIRURGIA . SN_UTI, 'S', 'Sim', 'Não') SN_UTI,
       DECODE(AVISO_CIRURGIA . SN_EXAME, 'S', 'Sim', 'Não') SN_EXAME,
       PACIENTE . DT_NASCIMENTO DT_NASCIMENTO,
       AVISO_CIRURGIA . VL_IDADE || ' \' || DECODE(AVISO_CIRURGIA . TP_IDADE, 'A', 'Anos', 'M', 'Meses', 'D', 'Dias') IDADE,
       UNID_INT . DS_UNID_INT DS_UTI
  FROM DBAMV . AGE_CIR AGE_CIR,
       DBAMV . SAL_CIR SAL_CIR,
       DBAMV . CEN_CIR CEN_CIR,
       DBAMV . AVISO_CIRURGIA AVISO_CIRURGIA,
       DBAMV . ATENDIME ATENDIME,
       DBAMV . PACIENTE PACIENTE,
       DBAMV . CONVENIO CONVENIO,
       DBAMV . LEITO LEITO,
       DBAMV . UNID_INT UNID_INT
 Where AVISO_CIRURGIA.CD_MULTI_EMPRESA = 1
   AND AGE_CIR.CD_SAL_CIR = SAL_CIR.CD_SAL_CIR
   AND AVISO_CIRURGIA.TP_SITUACAO <> 'C'
   AND AGE_CIR.CD_AVISO_CIRURGIA = AVISO_CIRURGIA.CD_AVISO_CIRURGIA
   AND ATENDIME.CD_ATENDIMENTO(+) = AVISO_CIRURGIA.CD_ATENDIMENTO
   AND ATENDIME.CD_PACIENTE = PACIENTE.CD_PACIENTE(+)
   AND ATENDIME.CD_CONVENIO = CONVENIO.CD_CONVENIO(+)
   AND CEN_CIR.CD_CEN_CIR = SAL_CIR.CD_CEN_CIR
   AND TO_CHAR(AGE_CIR.DT_INICIO_AGE_CIR, 'DD/MM/YYYY') = to_char(to_date('$data', 'dd/mm/yyyy'), 'dd/mm/yyyy')
   AND ATENDIME.CD_LEITO = LEITO.CD_LEITO(+)
   AND UNID_INT.CD_UNID_INT(+) = AVISO_CIRURGIA.CD_UNID_INT
   AND ATENDIME.CD_MULTI_EMPRESA(+) = 1
   ORDER BY 10 ASC,
   11 ASC,
   8 ASC,
   7 ASC,
   DS_CEN_CIR,
   DS_SAL_CIR,
   DT_INICIO_AGE_CIR,
   HR_INICIO_AGE_CIR


";
}

$objPHPExcel = new PHPExcel();

// Definimos o estilo da fonte
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);





            // Criamos as colunas
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Aviso' )
                ->setCellValue('B1', "Nome " )
                ->setCellValue("C1", "Hora" )
                ->setCellValue("D1", "Centro Cirúrgico / Sala" )
                ->setCellValue("E1", "Convênio" )
                ->setCellValue("F1", "Observação" )
                ->setCellValue("G1", "Cirurgia" )
                ->setCellValue("H1", "Cirurgião" )
                ->setCellValue("I1", "1º Auxiliar" )
                ->setCellValue("J1", "2º Auxiliar" )
                ->setCellValue("K1", "Anestesista" );



            // Podemos configurar diferentes larguras paras as colunas como padrão
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(80);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(50);




            $sql = oci_parse($conexao, $query_cirurgias_dia);
            oci_execute($sql);
            $i=1;




            while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
                //Validando campos antes de serem exibidos;
                if (!empty($row['CIRURGIAO'])) {$cirurgiao= $row['CIRURGIAO'];} else {$cirurgiao =  'Não cadastrado';}
                if (!empty($row['AUXILIAR1'])) {$auxiliar1= $row['AUXILIAR1'];} else {$auxiliar1 =  'Não cadastrado';}
                if (!empty($row['AUXILIAR2'])) {$auxiliar2= $row['AUXILIAR2'];} else {$auxiliar2 =  'Não cadastrado';}
                if (!empty($row['ANESTESISTA'])) {$anestesista= $row['ANESTESISTA'];} else {$anestesista =  'Não cadastrado';}
                if (!empty($row['CONVENIO'])) {$convenio= $row['CONVENIO'];} else {$convenio =  'Não cadastrado';}
                if (!empty($row['OBS_CIR'])) {$obs= $row['OBS_CIR'];} else {$obs =  'Não cadastrado';}
                if (!empty($row['DS_CIRURGIA'])) {$ds_cirurgia= $row['DS_CIRURGIA'];} else {$ds_cirurgia =  'Não cadastrado';}

            $i++;

                //Usando o contador para imprimir as linhas no layout desejado
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $row['CD_AVISO_CIRURGIA']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $row['NM_PACIENTE']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $row['HR_INICIO_AGE_CIR']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $row['DS_SAL_CIR']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $convenio);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $obs);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $ds_cirurgia);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $cirurgiao);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $auxiliar1);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $auxiliar2);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, $anestesista);

            }



            oci_free_statement($sql);
            oci_close($conexao);





            // Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
            $objPHPExcel->getActiveSheet()->setTitle('Mapa cirurgico do dia');

            // Cabeçalho do arquivo para ele baixar
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$nome_arquivo.'_mapa_cirurgico"');
            header('Cache-Control: max-age=0');
            // Se for o IE9, isso talvez seja necessário
            header('Cache-Control: max-age=1');

            // Acessamos o 'Writer' para poder salvar o arquivo
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

            // Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
            $objWriter->save('php://output');

            exit;

            ?>
