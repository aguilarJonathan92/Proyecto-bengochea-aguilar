<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index()
    {
        $ofertas_home = [
            [
                "id" => 1,
                "image" => "images/guitarra-prs.webp",
                "title" => "Guitarra eléctrica versátil",
                "subtitle" => "PRS SE 24-08 Standard Tobacco Sunburst",
                "price" => 2474529,
                "installments" => 3,
                "installment_price" => 824843,
                "category" => "Instrumentos",
                "brand" => "PRS",
                "on_sale" => true,
                "discount" => 15
            ],
            [
                "id" => 3,
                "image" => "images/guitarra-benson.webp",
                "title" => "Guitarra eléctrica tipo Stratocaster",
                "subtitle" => "Benson HD 901 BK",
                "price" => 609709,
                "installments" => 3,
                "installment_price" => 203236.33,
                "category" => "Instrumentos",
                "brand" => "Benson",
                "on_sale" => true,
                "discount" => 10
            ],
            [
                "id" => 6,
                "image" => "images/guitarra-prs.webp",
                "title" => "Guitarra eléctrica double cutaway",
                "subtitle" => "PRS SE Custom 24-08",
                "price" => 3219129,
                "installments" => 3,
                "installment_price" => 1073043,
                "category" => "Instrumentos",
                "brand" => "PRS",
                "on_sale" => true,
                "discount" => 20
            ],
            [
                "id" => 7,
                "image" => "images/piano-yamaha.webp",
                "title" => "Piano digital compacto",
                "subtitle" => "Yamaha P-45",
                "price" => 1850000,
                "installments" => 3,
                "installment_price" => 616666,
                "category" => "Instrumentos",
                "brand" => "Yamaha",
                "on_sale" => true,
                "discount" => 10
            ]
        ];
        foreach ($ofertas_home as &$product) {
            $product['final_price'] = $product['on_sale']
                ? $product['price'] - ($product['price'] * $product['discount'] / 100)
                : $product['price'];
        }

        $mas_visitados = [
            [
                "id" => 8,
                "image" => "images/piano-casio.webp",
                "title" => "Piano digital profesional",
                "subtitle" => "Casio Privia PX-160",
                "price" => 2100000,
                "installments" => 3,
                "installment_price" => 700000,
                "category" => "Instrumentos",
                "brand" => "Casio",
                "on_sale" => false,
                "discount" => 0
            ],
            [
                "id" => 12,
                "image" => "images/auricular-2.webp",
                "title" => "Auriculares profesionales",
                "subtitle" => "Sony MDR-7506",
                "price" => 250000,
                "installments" => 3,
                "installment_price" => 83333,
                "category" => "Audio",
                "brand" => "Sony",
                "on_sale" => false,
                "discount" => 0
            ],
            [
                "id" => 16,
                "image" => "images/flauta-2.webp",
                "title" => "Flauta traversa profesional",
                "subtitle" => "Gemeinhardt 2SP",
                "price" => 1100000,
                "installments" => 3,
                "installment_price" => 366666,
                "category" => "Instrumentos",
                "brand" => "Gemeinhardt",
                "on_sale" => false,
                "discount" => 0
            ],
            [
                "id" => 18,
                "image" => "images/bajo-2.webp",
                "title" => "Bajo eléctrico clásico",
                "subtitle" => "Fender Precision Bass",
                "price" => 1600000,
                "installments" => 3,
                "installment_price" => 533333,
                "category" => "Instrumentos",
                "brand" => "Fender",
                "on_sale" => false,
                "discount" => 0
            ]
        ];
        $novedades = [
            [
                "id" => 5,
                "image" => "images/guitarra-cort.webp",
                "title" => "Guitarra electroacústica dreadnought",
                "subtitle" => "Cort AD810E",
                "price" => 406569,
                "installments" => 3,
                "installment_price" => 135523,
                "category" => "Instrumentos",
                "brand" => "Cort",
                "on_sale" => false,
                "discount" => 10
            ],
            [
                "id" => 10,
                "image" => "images/clarinete-2.webp",
                "title" => "Clarinete profesional",
                "subtitle" => "Buffet Crampon E11",
                "price" => 1450000,
                "installments" => 3,
                "installment_price" => 483333,
                "category" => "Instrumentos",
                "brand" => "Buffet",
                "on_sale" => false,
                "discount" => 0
            ],
            [
                "id" => 20,
                "image" => "images/microfono-2.webp",
                "title" => "Micrófono condensador",
                "subtitle" => "AKG P120",
                "price" => 210000,
                "installments" => 3,
                "installment_price" => 70000,
                "category" => "Audio",
                "brand" => "AKG",
                "on_sale" => false,
                "discount" => 0
            ],
            [
                "id" => 22,
                "image" => "images/teclado-2.webp",
                "title" => "Teclado profesional",
                "subtitle" => "Yamaha PSR-E373",
                "price" => 620000,
                "installments" => 3,
                "installment_price" => 206666,
                "category" => "Instrumentos",
                "brand" => "Yamaha",
                "on_sale" => false,
                "discount" => 0
            ]
        ];
        return view('pages.home', compact('ofertas_home', 'mas_visitados', 'novedades'));
    }

    public function terms()
    {
        return view('pages.term-and-uses');
    }

    public function about()
    {
        return view('pages.about');
    }
    
    public function marketing()
    {
        return view('pages.marketing');
    }
}
