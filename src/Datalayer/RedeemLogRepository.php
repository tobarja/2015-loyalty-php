<?php

namespace Loyalty\Datalayer;

class RedeemLogRepository {
    protected $db;

    public function __construct(\PDO &$db) {
        $this->db = $db;
    }

    public function Get($id) {
        $sql = <<<EOT
            select id, Time, Customer, User, Point from RedeemLog
            where id = :id
EOT;

        $statement = $this->db->prepare($sql);
        $dbresult = $statement->execute(array("id" => $id));
        if ($dbresult == null) {
            return new RedeemLog("","","");
        }
        $dbrow = $statement->fetch();
        $result = \Loyalty\Model\RedeemLog::Hydrate($id,
            $dbrow['Time'], $dbrow['User'], $dbrow['Point']);
        return $result;
    }

    public function Save(\Loyalty\Model\RedeemLog $record) {
        if ($record->id() == null) {
            $sql = <<<EOT
                insert into RedeemLog (Time, Customer, User, Point)
                values (:Time, :Customer, :User, :Point)
EOT;

            $statement = $this->db->prepare($sql);

            $params = array('Time' => $record->Time,
                'Customer' => $record->Customer,
                'User' => $record->User,
                'Point' => $record->Point);

        } else {
            $sql = <<<EOT
                UPDATE RedeemLog
                SET `Time` = :Time, `Customer` = :Customer, `User` = :User, `Point` = :Point
                where id = :id
EOT;

            $statement = $this->db->prepare($sql);

            $params = array('Time' => $record->Time,
                'Customer' => $record->Customer,
                'User' => $record->User,
                'Point' => $record->Point,
                'id' => $record->id());
        }

        return $statement->execute($params);
    }

    public function Delete($id) {
        $sql = "delete from RedeemLog where id = :id";
        $statement = $this->db->prepare($sql);

        $params = array('id' => $id);

        return $statement->execute($params);
    }
}
