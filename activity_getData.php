<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

try {
    require_once("./connect_cid101g3.php");
    
    $returnData = [
        'code' => 200,
        'msg' => '',
        'data' => []
    ];

    // 執行 SQL
    $sql = "SELECT * FROM activity ORDER BY act_id";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    
    // 獲取所有結果
    $activityData = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    $returnData['data']['list'] = $activityData;
    $returnData['msg'] = 'Success';

} catch (PDOException $e) {
    $returnData['code'] = 10003;
    $returnData['msg'] = "Database error: " . $e->getMessage();
} catch (Exception $e) {
    $returnData['code'] = 10004;
    $returnData['msg'] = "General error: " . $e->getMessage();
}

echo json_encode($returnData);
?>