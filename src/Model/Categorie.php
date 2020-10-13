<?php
namespace src\Model;

class Categorie
{
    private $id;
    private $libelle;
    private $icone;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Categorie
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     * @return Categorie
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIcone()
    {
        return $this->icone;
    }

    /**
     * @param mixed $icone
     * @return Categorie
     */
    public function setIcone($icone)
    {
        $this->icone = $icone;
        return $this;
    }




    public function SqlAdd(\PDO $bdd){
        try {
            $requete = $bdd->prepare("INSERT INTO categorie (libelle, icone  )
 VALUES(:libelle, :icone)");

            $requete->execute([
                "libelle" => $this->getlibelle(),
                "icone" => $this->geticone(),

            ]);
            return $bdd->lastInsertId();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    public function SqlUpdate(\PDO $bdd){
        try {
            $requete = $bdd->prepare("UPDATE categorie set libelle= :libelle, icone = :icone, WHERE Id = :Id");

            $requete->execute([
                "libelle" => $this->getLibelle(),
                "icone" => $this->getIcone(),

                "Id" => $this->getId()
            ]);
            return "OK";
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }
    /**
     * Récupère tous les articles
     * @param \PDO $bdd
     * @return array
     */
    public function SqlGetAll(\PDO $bdd){
        $requete = $bdd->prepare("SELECT * FROM categorie");
        $requete->execute();
        //$datas =  $requete->fetchAll(\PDO::FETCH_ASSOC);
        $datas =  $requete->fetchAll(\PDO::FETCH_CLASS,'src\Model\Article');
        return $datas;

    }

    public function SqlGetById(\PDO $bdd, $Id){
        $requete = $bdd->prepare("SELECT * FROM categorie WHERE Id=:Id");
        $requete->execute([
            "Id" => $Id
        ]);
        $requete->setFetchMode(\PDO::FETCH_CLASS,'src\Model\categorie');
        $article = $requete->fetch();

        return $article;
    }

    public function SqlDeleteById(\PDO $bdd, $Id){
        $requete = $bdd->prepare("DELETE FROM categorie WHERE Id=:Id");
        $requete->execute([
            "Id" => $Id
        ]);
        return true;
    }


}