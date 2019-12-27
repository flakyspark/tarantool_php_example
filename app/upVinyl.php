<?php
require_once __DIR__ . '/vendor/autoload.php';

use Tarantool\Client\Client;

$client = Client::fromOptions([
        'uri' => 'tarantool:3301'
    ]);

$sql = <<<SQL
CREATE TABLE snapshot_verification_result (
  rule_id INTEGER,
  trigger_id INTEGER,
  answer_set_id INTEGER,
  answer_source_type_id INTEGER,
  client_id INTEGER,
  result INTEGER,
  trigger_hash VARCHAR(32),
  created_date VARCHAR(20),
  PRIMARY KEY (rule_id,trigger_id,answer_set_id,answer_source_type_id)
) WITH ENGINE = 'vinyl';
SQL;

$result = $client->executeUpdate($sql);

echo 'Table created.' . PHP_EOL;
