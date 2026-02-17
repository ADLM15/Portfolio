<?php

class Serie {
    private string $titre;
    private string $auteur;
    private int $anneeProduction;
    private array $genres = [];
    private string $langue;
    private string $status;
    private float $notation;
    private array $episodes = [];

    public function __construct(
        string $titre,
        string $auteur,
        int $anneeProduction,
        array $genres,
        string $langue,
        string $status,
        float $notation
    ){
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->anneeProduction = $anneeProduction;
        $this->genres = $genres;
        $this->langue = $langue;
        $this->status = $status;
        $this->notation = $notation;
    }

    public function ajouterEpisode(Episode $episode): void {
        $this->episodes[] = $episode;
    }

    public function afficherDetails(): void {
        echo "Titre : {$this->titre}
";
        echo "Auteur : {$this->auteur}
";
        echo "Année : {$this->anneeProduction}
";
        echo "Genres : " . implode(", ", $this->genres) . "
";
        echo "Langue : {$this->langue}
";
        echo "Status : {$this->status}
";
        echo "Notation : {$this->notation}/10
";
        echo "Nombre d'épisodes : " . count($this->episodes) . "
";
    }

    public function getEpisodes(): array {
        return $this->episodes;
    }
}

class Episode {
    private int $numero;
    private string $titre;
    private int $duree;
    private DateTime $dateDiffusion;

public function __construct(int $numero, string $titre, int $duree, DateTime $dataDiffusion){
    $this->numero = $numero;
    $this->tutre = $titre;
    $this->duree = $duree;
    $this->dateDiffusion = $dateDiffusion;
}

public function getDate(): DateTime{
    return $this->dateDiffusion;
}
}

class Calendrier{
    private array $episode = [];

    public function ajouter(Episode $episode): void{
        $this->episodes[] = $episode;
    }

    public function afficherPlanning(): void {
        usort($this->episodes, function($a, $b){
            return $a->getDate() <=> $b->getDate();
        });

        foreach($this->episodes as $ep){
            $ep->afficherDetails();
            echo "
";
        }
    }
}
