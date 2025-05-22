<?php
class NoweAuto
{
    public $model;
    public $cenaEuro;
    public $kurs;

    public function __construct(string $model, float $cenaEuro, float $kurs)
    {
        $this->model = $model;
        $this->cenaEuro = $cenaEuro;
        $this->kurs = $kurs;
    }

    public function obliczCene(): float
    {
        return $this->cenaEuro * $this->kurs;
    }
}

class AutoZDodatkami extends NoweAuto
{
    public $alarm;
    public $radio;
    public $klimatyzacja;

    public function __construct(
        string $model,
        float $cenaEuro,
        float $kurs,
        float $alarm = 0.0,
        float $radio = 0.0,
        float $klimatyzacja = 0.0
    ) {
        parent::__construct($model, $cenaEuro, $kurs);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    public function obliczCene(): float
    {
        $totalEuro = $this->cenaEuro + $this->alarm + $this->radio + $this->klimatyzacja;
        return $totalEuro * $this->kurs;
    }
}

class Ubezpieczenie extends AutoZDodatkami
{
    public $procent;
    public $lata;

    public function __construct(
        string $model,
        float  $cenaEuro,
        float  $kurs,
        float  $alarm,
        float  $radio,
        float  $klimatyzacja,
        float  $procent,
        int    $yearsOwned
    ) {
        parent::__construct($model, $cenaEuro, $kurs, $alarm, $radio, $klimatyzacja);
        $this->procent = $procent;
        $this->lata = $yearsOwned;
    }

    public function obliczCene(): float
    {
        $cenaPLN = parent::obliczCene();
        $depreciationPct = max(0, (100 - $this->lata)) / 100;

        return $this->procent * ($cenaPLN * $depreciationPct);
    }
}

$auto = new NoweAuto('x', 15000, 4.24);
echo 'auto x: ' . $auto->obliczCene() . "<br>";

$autoDodatki = new AutoZDodatkami('y', 15000, 4.24, 300, 200, 1000);
echo 'auto y z dodatkami: ' . $autoDodatki->obliczCene() . "<br>";

$ubezpieczenie = new Ubezpieczenie('y', 15000, 4.24, 300, 200, 1000, 0.05, 2);
echo 'ebezpieczenie auta y: ' . $ubezpieczenie->obliczCene() . "<br>";

?>
