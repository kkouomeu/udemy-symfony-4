<?php


namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * @var string
     */
    private $locale;


    /**
     * AppExtension constructor.
     */
    public function __construct(string  $locale)
    {
        $this->locale = $locale;
    }

    /**
     * @inheritDoc
     */
    public function getGlobals()
    {
        return ['locale' => $this->locale ];
    }

    public function getFilters()
    {
        return [
          new TwigFilter('price', [$this, 'priceFilter'])
        ];
    }

    public function priceFilter($number)
    {
        return number_format($number, 2,'.',',').' €';
    }


}