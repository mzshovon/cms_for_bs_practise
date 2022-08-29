<?php
// Define the query class
Class Query {
    public function __construct($table, $value, $attr, $connection)
    {
        $this->table = $table;
        $this->value = $value;
        $this->attr = $attr;
        $this->connection = $connection;
    }
    // Fetch all the data from table
    public function all()
    {
        $query = "select * from .$this->table";
        $result = mysqli_query($this->connection, $query);
        return mysqli_fetch_row($result);
    }
}