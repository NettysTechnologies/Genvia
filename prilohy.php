<?php
session_start();
if(!isset($_SESSION["admin"])){
    header("Location: login.php", true, 303);
}

require_once("tcpdf_min/tcpdf.php");

$Allgens = explode("\n", file_get_contents('csvToPdf/' . $_GET["file"] . '.csv')); // Rozdělení csv podle řádků do pole

$literature = explode("\n", file_get_contents('csvToPdf/literature.csv'));

class PDF extends TCPDF

{

    // Hlavička pdf
    public function header()
    {
        $this->Ln(10);
        $this->addFont("dejavusans", "", "dejavusans.php"); // Přidání vlastního fontu
        $this->SetFont("dejavusans", "", 20);
        $this->SetTextColor(0, 30, 87);
        $this->MultiCell(140, 5, "Příloha k výsledku vyšetření genetických predispozic ke sportu", 0, "L");
        $this->Image("assets/logo.jpg", 170, 10, 35, 20); // Obrázek v hlaviččce
        $this->Ln(5);
        $this->SetFont("dejavusans", "", 10);
        $this->Cell(100, 10, $_GET["name"]);
        $this->Line(10, 45, 210 - 10, 45, array("color" => array(211, 211, 211)));
    }

    // Patička pdf
    public function footer()
    {
        $this->Ln();
        $this->SetFont("dejavusans", "", 10);
        $this->SetTextColor(0, 30, 87);
        $this->SetXY(10, 270);
        $this->Line(10, 270, 210 - 10, 270, array("color" => array(211, 211, 211))); // Linky nad patičkou
        $this->Cell(90, 10, "Příloha: " . $this->getNumPages() . " / " . $this->getAliasNbPages()); // Označení jednotlivých stránek
        $this->setXY(160, $this->getY());
        $this->Cell(100, 10, "www.testovanigenu.cz");
        $this->Ln();
    }

    // Tisknutí genů
    public function gens($Allgens)
    {
        $this->setXY(35, 40); // Nastavení souřadnicové pozice
        $this->SetTextColor(0, 30, 87);

        for ($i = 1; $i < count($Allgens) - 2; $i++) {
            $gen = explode(";", $Allgens[$i]); // Rozdělení do pole podle delimeteru středníku

            $this->Ln(5);
            $x = $this->GetX();
            $y = $this->GetY();

            $this->SetXY($x, $y);
            $this->Line(10, $y, 210 - 10, $y, array("color" => array(211, 211, 211)));
            $this->Ln(5);

            $this->SetFont("dejavusans", "", 8);

            $this->Cell(40, 5, "Gen: ", 0, "");
            $this->Cell(40, 5, "Referenční alela: ", 0, "");
            $this->Cell(30, 5, "Genotyp: ", 0, "");
            $this->Cell(70, 5, "Účinek alely: ", 0, "");
            $this->Ln(5);

            $this->SetTextColor(0, 0, 100);
            $this->SetFont("dejavusans", "B", 8);

            $this->Cell(40, 5, $gen[0], 0, "");
            $this->Cell(40, 5, $gen[2], 0, "");
            $this->Cell(30, 5, $gen[4], 0, "");

            $this->SetXY($this->getX(), $this->getY());

            $this->MultiCell(70, 5, $gen[5], 0, "");
            $this->Ln(5);

            $this->SetFont("dejavusans", "", 8);

            $this->Cell(40, 5, "Číslo vyrianty: ", 0, "");
            $this->Cell(40, 5, "Alternativní alela: ", 0, "");
            $this->Cell(30, 5, "Studie: ", 0, "");
            $this->Cell(70, 5, "Popis genu: ", 0, "");
            $this->Ln();

            $this->SetFont("dejavusans", "B", 8);

            $this->Cell(40, 5, $gen[1], 0, "");
            $this->Cell(40, 5, $gen[3], 0, "");

            $x = $this->GetX();
            $firstY = $this->GetY();

            $this->SetXY($x, $firstY);

            $this->MultiCell(30, 5, "(" . $gen[6] . ")", 0, "");

            $this->SetFont("dejavusans", "", 8);

            $x = $this->GetX();

            $this->SetXY($x + 110, $firstY);
            $this->MultiCell(70, 5, $gen[7], 0, "L");

            if ($this->getY() >= 220) { // Vytváření nové stránky
                $this->AddPage();
                $this->setXY(35, 40);
            }
        }
    }

    // Tisknutí literatury
    public function literature($literature)
    {
        $this->addPage();
        $this->SetXY(10, 60);
        $this->setTextColor(0, 30, 87); // Nastavení barvy
        $this->SetFont("dejavusans", "B", 12);
        $this->Cell(100, 15, "Literatura", 0, 0);
        $this->Ln();
        $this->SetFont("dejavusans", "", 8);
        for ($i = 1; $i < count($literature); $i++) {
            $lit = preg_split("/[\t]/", $literature[$i]); // Rozdělení do pole podle delimeteru tabulátoru

            $this->Cell(10, 5, "(" . $lit[0] . ")", 0, "");

            $this->MultiCell(150, 5, $lit[2], 0, "");

            $this->Ln(5);

            $pageY = $this->GetY();

            if ($pageY >= 240) {
                $this->addPage();
                $this->SetXY(10, 60);
            }
        }

        $this->SetFont("dejavusans", "", 10);

        $this->setXY(10, 250);
        $y = $this->getY();
        $this->cell(70, 5, "Přílohu vytvořil: Genvia");

        $this->setXY($this->getX(), $this->getY());
        $this->Multicell(100, 5, "Tato příloha je nedílnou součástí výsledku vyšetření a samostatně nelze přílohu ani výsledek interpretovat!");

        $this->Ln(5);
        $this->setXY($this->getX(), $y + 5);
        $this->cell(120, 5, "Datum: " . date("d/m/Y")); // Nastavení datumu v příslušném formátu
    }
}

$pdf = new PDF("P", "mm", "A4", true, "UTF-8", false);

$pdf->AddPage();

$pdf->gens($Allgens);

$pdf->literature($literature);

ob_end_clean();

$pdf->Output("PrilohyPredispozic-".$_GET["file"].".pdf", "D"); // Název souboru, ["D" => stáhnutí] nebo ["I" => náhled]
