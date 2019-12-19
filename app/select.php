<?php
require_once __DIR__ . '/vendor/autoload.php';

use Tarantool\Client\Client;

$client = Client::fromOptions([
    'uri' => 'tarantool:3301'
]);

$count = 0;
echo 'Processing...' . PHP_EOL;

$time_start = microtime(true);

for ($ruleId=1 ; $ruleId < 50; $ruleId ++) {
    for ($triggerId=1 ; $triggerId < 50; $triggerId ++) {
        for ($answerSetId=1 ; $answerSetId < 50; $answerSetId ++) {
            $select = "SELECT * FROM snapshot_verification_result  WHERE rule_id = ? AND trigger_id = ? AND answer_set_id = ? AND answer_source_type_id = ?";
            $result = $client->executeQuery($select, $ruleId, $triggerId, $answerSetId, mt_rand(1, 50));
            $count++;
        }
    }
}

$time_end = microtime(true);
$time = $time_end - $time_start;

echo 'Finish. Selected ' . $count . ' rows' . PHP_EOL;
echo 'Time: ' . $time . PHP_EOL;
