<?php
//Conexão
include_once('../../oracle/connec.php');


$query_cirurgias_dia = '
SELECT AGE_CIR . CD_AGE_CIR CD_AGE_CIR,
       TRUNC(AGE_CIR . DT_INICIO_AGE_CIR) DT_INICIO_AGE_CIR,
       TO_CHAR(AGE_CIR . DT_INICIO_AGE_CIR, \'HH24:MI\') HR_INICIO_AGE_CIR,
       AVISO_CIRURGIA . CD_AVISO_CIRURGIA CD_AVISO_CIRURGIA,
       AVISO_CIRURGIA . NR_TELEFONE_CONTATO NR_TELEFONE_CONTATO,
       ATENDIME . CD_ATENDIMENTO CD_ATENDIMENTO,
       SAL_CIR . CD_SAL_CIR CD_SAL_CIR,
       SAL_CIR . DS_SAL_CIR DS_SAL_CIR,
       SAL_CIR . DS_RESUMIDA DS_RESUMIDA,
       CEN_CIR . CD_CEN_CIR CD_CEN_CIR,
       CEN_CIR . DS_CEN_CIR DS_CEN_CIR,
       NVL(PACIENTE . CD_PACIENTE, AVISO_CIRURGIA . CD_PACIENTE) CD_PACIENTE,
       NVL(PACIENTE . NM_PACIENTE, AVISO_CIRURGIA . NM_PACIENTE) NM_PACIENTE,
       CONVENIO . CD_CONVENIO CD_CONVENIO,
       CONVENIO . NM_CONVENIO NM_CONVENIO,
       LEITO . DS_RESUMO DS_LEITO,
       DECODE(AVISO_CIRURGIA . SN_UTI, \'S\', \'Sim\', \'Não\') SN_UTI,
       DECODE(AVISO_CIRURGIA . SN_EXAME, \'S\', \'Sim\', \'Não\') SN_EXAME,
       PACIENTE . DT_NASCIMENTO DT_NASCIMENTO,
       AVISO_CIRURGIA . VL_IDADE || \' \' || DECODE(AVISO_CIRURGIA . TP_IDADE, \'A\', \'Anos\', \'M\', \'Meses\', \'D\', \'DIAS\') IDADE,
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
   AND AVISO_CIRURGIA.TP_SITUACAO <> \'C\'
   AND AGE_CIR.CD_AVISO_CIRURGIA = AVISO_CIRURGIA.CD_AVISO_CIRURGIA
   AND ATENDIME.CD_ATENDIMENTO(+) = AVISO_CIRURGIA.CD_ATENDIMENTO
   AND ATENDIME.CD_PACIENTE = PACIENTE.CD_PACIENTE(+)
   AND ATENDIME.CD_CONVENIO = CONVENIO.CD_CONVENIO(+)
   AND CEN_CIR.CD_CEN_CIR = SAL_CIR.CD_CEN_CIR
   AND TO_CHAR(AGE_CIR.DT_INICIO_AGE_CIR, \'DD/MM/YYYY\') =
       to_char(to_date(\'20/05/2015\', \'dd/mm/yyyy\'), \'dd/mm/yyyy\') --Data agendamento
   AND ATENDIME.CD_LEITO = LEITO.CD_LEITO(+)
   AND UNID_INT.CD_UNID_INT(+) = AVISO_CIRURGIA.CD_UNID_INT
   AND ATENDIME.CD_MULTI_EMPRESA(+) = 1
 ORDER BY 10                ASC,
          11                ASC,
          8                 ASC,
          7                 ASC,
          DS_CEN_CIR,
          DS_SAL_CIR,
          DT_INICIO_AGE_CIR,
          HR_INICIO_AGE_CIR

';




            $sql = oci_parse($conexao, $query_cirurgias_dia);
            oci_execute($sql);
            $i=0;
            while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            $i=$i++;
                print $row['CD_AVISO_CIRURGIA'].' - ';


            }

            oci_free_statement($sql);
            oci_close($conexao);

