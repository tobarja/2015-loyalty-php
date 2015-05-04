<?php
namespace Loyalty\Datalayer;

class CustomerRepository {
    protected $db;

    public function __construct(\PDO &$db) {
        $this->db = $db;
    }

    public function Get($id) {
        $sql = <<<EOT
            select CustomerID, FirstName, LastName, Telephone, Points, Email from Customers
            where CustomerID = :CustomerID
EOT;

        $statement = $this->db->prepare($sql);
        $dbresult = $statement->execute(array("CustomerID" => $id));
        if ($dbresult == null) {
            return new Customer("","","","","");
        }
        $dbrow = $statement->fetch();
        $result = \Loyalty\Model\Customer::Hydrate($id,
            $dbrow['FirstName'], $dbrow['LastName'], $dbrow['Telephone'], $dbrow['Email'], $dbrow['Points']);
        return $result;
    }

    public function Save(\Loyalty\Model\Customer $record) {
        if ($record->id() == null) {
            $sql = <<<EOT
                insert into Customers (FirstName, LastName, Points, Telephone, Email)
                values (:FirstName, :LastName, :Points, :Telephone, :Email)
EOT;

            $statement = $this->db->prepare($sql);

            $params = array('FirstName' => $record->FirstName,
                'LastName' => $record->LastName,
                'Points' => $record->Points,
                'Telephone' => $record->Telephone,
                'Email' => $record->Email);

        } else {
            $sql = <<<EOT
                UPDATE Customers
                SET FirstName = :FirstName, LastName = :LastName, Points = :Points, Telephone = :Telephone, Email= :Email
                where CustomerID = :CustomerID
EOT;

            $statement = $this->db->prepare($sql);

            $params = array('FirstName' => $record->FirstName,
                'LastName' => $record->LastName,
                'Points' => $record->Points,
                'Telephone' => $record->Telephone,
                'Email' => $record->Email,
                'CustomerID' => $record->id());
        }

        return $statement->execute($params);
    }

    public function Delete($id) {
        $sql = "delete from Customers where CustomerID = :CustomerID";
        $statement = $this->db->prepare($sql);

        $params = array('CustomerID' => $id);

        return $statement->execute($params);
    }

    public function RawFuzzySearch($searchText) {
        $sql = <<<EOT
            select CustomerID, FirstName, LastName, Telephone, Points from Customers
            where CONCAT(FirstName, ' ', LastName) like :searchString
            or LastName like :searchString or Telephone like :searchString LIMIT 10
EOT;

        $statement = $this->db->prepare($sql);
        $params = array('searchString' => $searchText . '%');

        $dbresult = $statement->execute($params);
        if ($dbresult) {
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        }
        return false;
    }
}
