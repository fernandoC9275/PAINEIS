<?php
//Conexão
include_once('../../../oracle/connec_mv2000.php');

// Incluimos a classe PHPExcel
include  '../../classes/PHPExcel.php';

$data_inicial = $_POST['data_inicial'];
$data_final = $_POST['data_inicial'];
$nome_arquivo  = str_replace('/', '_',$data_inicial.'_'.$data_final);

if(substr($data_inicial,-4) != '2014' || substr($data_final,-4) != '2014'){
    echo "<script>alert('Pesquisa apenas para 2014')</script>";
    echo "<script>history.go(-1)</script>";
    exit();
}




if(isset($data_inicial)) {
    $query = "SELECT A.CD_ENT_PRO,
A.CD_ESTOQUE,
A.DS_ESTOQUE,
A.HR_ENTRADA,
A.CD_PRODUTO,
A.CD_ATENDIMENTO,
A.CD_FORNECEDOR,
A.DS_PRODUTO,
A.QT_ENTRADA,
A.VL_UNITARIO,
A.VL_TOTAL,
A.TP_DOCUMENTO_ENTRADA,
A.DT_REALIZACAO,
A.NM_FORNECEDOR,
A.NR_NF,
SUM(A.VL_TOTAL) TOTAL_GERAL
FROM VDIC_CSSJ_NOTAS_2014_CONSIG A WHERE A.DT_REALIZACAO BETWEEN '$data_inicial' AND '$data_final'
GROUP BY
 A.CD_ENT_PRO,
A.CD_ESTOQUE,
A.DS_ESTOQUE,
A.HR_ENTRADA,
A.CD_PRODUTO,
A.CD_ATENDIMENTO,
A.CD_FORNECEDOR,
A.DS_PRODUTO,
A.QT_ENTRADA,
A.VL_UNITARIO,
A.VL_TOTAL,
A.TP_DOCUMENTO_ENTRADA,
A.DT_REALIZACAO,
A.NM_FORNECEDOR,
A.NR_NF

";
$query2 = "SELECT SUM(A.VL_TOTAL) TOTAL_GERAL FROM VDIC_CSSJ_NOTAS_2014_CONSIG A WHERE A.DT_REALIZACAO BETWEEN '$data_inicial' AND '$data_final'";
}

$sql = oci_parse($conexao, $query2);
oci_execute($sql);

while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
 $TOTAL_GERAL = $row['TOTAL_GERAL'];
}

$objPHPExcel = new PHPExcel();

// Definimos o estilo da fonte
$objPHPExcel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);





            // Criamos as colunas
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'CD_ENT_PRO' )
                ->setCellValue('B1', "CD_ESTOQUE " )
                ->setCellValue("C1", "ESTOQUE" )
                ->setCellValue("D1", "HR_ENTRADA" )
                ->setCellValue("E1", "PRODUTO" )
                ->setCellValue("F1", "CD ATENDIMENTO" )
                ->setCellValue("G1", "FORNECEDOR" )
                ->setCellValue("H1", "QT ENTRADA" )
                ->setCellValue("I1", "VL UNITÁRIO" )
                ->setCellValue("J1", "VL TOTAL" )
                ->setCellValue("K1", "DT REALIZAÇÃO" )
                ->setCellValue("L1", "NR-NF" )
                ->setCellValue("M1", "TOTAL GERAL: " )
                ->setCellValue("N1", $TOTAL_GERAL );



            // Podemos configurar diferentes larguras paras as colunas como padrão
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);






            $sql = oci_parse($conexao, $query);
            oci_execute($sql);
            $i=1;


            while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
                //Validando campos antes de serem exibidos;

            $i++;

                //Usando o contador para imprimir as linhas no layout desejado
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $row['CD_ENT_PRO']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $row['CD_ESTOQUE']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $row['DS_ESTOQUE']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $row['HR_ENTRADA']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $row['DS_PRODUTO']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $row['CD_ATENDIMENTO']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $row['NM_FORNECEDOR']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $row['QT_ENTRADA']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $row['VL_UNITARIO']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $row['VL_TOTAL']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, $row['DT_REALIZACAO']);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $i, $row['NR_NF']);


            }



            oci_free_statement($sql);
            oci_close($conexao);





            // Podemos renomear o nome das planilha atual, lembrando que um único arquivo pode ter várias planilhas
            $objPHPExcel->getActiveSheet()->setTitle('Notas Consignados');

            // Cabeçalho do arquivo para ele baixar
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$nome_arquivo.'_consumo_consignado"');
            header('Cache-Control: max-age=0');
            // Se for o IE9, isso talvez seja necessário
            header('Cache-Control: max-age=1');

            // Acessamos o 'Writer' para poder salvar o arquivo
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

            // Salva diretamente no output, poderíamos mudar arqui para um nome de arquivo em um diretório ,caso não quisessemos jogar na tela
            $objWriter->save('php://output');

            exit;

            ?>
