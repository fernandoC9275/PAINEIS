<?php
include_once('../../../oracle/connec.php');

$arr = array();
if (!empty($_GET['busca'])) {
    $keywords = strtoupper(trim($_GET['busca']));

    $query = "select cd_pro_fat, ds_pro_fat from pro_fat WHERE ds_pro_fat LIKE '".$keywords."%'";

    $sql = oci_parse($conexao, $query);
    oci_execute($sql);

    while (($row = oci_fetch_array($sql, OCI_BOTH)) != false) {
            $arr[] = array('id' => $row['CD_PRO_FAT'], 'desc' => $row['DS_PRO_FAT']);
        }

}
echo json_encode($arr);