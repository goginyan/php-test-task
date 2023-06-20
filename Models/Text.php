<?php
require_once('BaseModel.php');
class Text extends BaseModel
{
    public function create(string $text)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO texts (text) VALUES (?)");
            $stmt->execute([$text]);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            exit();
        }

        return true;
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function get(int $id): ?array
    {
        $stmt = $this->conn->prepare("SELECT id, text FROM texts WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return count($result) ? $result[0] : null;
    }
}