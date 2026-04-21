<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(){
        $json = '[
            {
                "id": 1,
                "image": "images/guitarra-prs.webp",
                "title": "Guitarra eléctrica versátil",
                "subtitle": "PRS SE 24-08 Standard Tobacco Sunburst",
                "price": 2474529,
                "installments": 3,
                "installment_price": 824843,
                "category": "guitarras",
                "brand": "PRS",
                "on_sale": true,
                "discount": 15
            },
            {
                "id": 2,
                "image": "images/guitarra-fender.webp",
                "title": "Guitarra electroacústica dreadnought con cutaway",
                "subtitle": "Fender Redondo™ Player",
                "price": 858299,
                "installments": 3,
                "installment_price": 286099.67,
                "category": "guitarras",
                "brand": "Fender",
                "on_sale": false,
                "discount": 0
            },
            {
                "id": 3,
                "image": "images/guitarra-benson.webp",
                "title": "Guitarra eléctrica tipo Stratocaster",
                "subtitle": "Benson HD 901 BK",
                "price": 609709,
                "installments": 3,
                "installment_price": 203236.33,
                "category": "guitarras",
                "brand": "Benson",
                "on_sale": true,
                "discount": 10
            },
             {
                "id": 4,
                "image": "images/guitarra-cort.webp",
                "title": "Guitarra acústica concierto",
                "subtitle": "Cort AD810M Mahogany",
                "price": 368449,
                "installments": 3,
                "installment_price": 122816.33,
                "category": "guitarras",
                "brand": "Cort",
                "on_sale": false,
                "discount": 25
            },
             {
                "id": 5,
                "image": "images/guitarra-cort.webp",
                "title": "Guitarra electroacústica dreadnought",
                "subtitle": "Cort AD810E",
                "price": 406569,
                "installments": 3,
                "installment_price": 135523,
                "category": "guitarras",
                "brand": "Cort",
                "on_sale": false,
                "discount": 10
            }, 
            {
                "id": 6,
                "image": "images/guitarra-prs.webp",
                "title": "Guitarra eléctrica double cutaway",
                "subtitle": "PRS SE Custom 24-08",
                "price": 3219129,
                "installments": 3,
                "installment_price": 1073043,
                "category": "guitarras",
                "brand": "PRS",
                "on_sale": true,
                "discount": 20
            },
            {
                "id": 7,
                "image": "images/piano-yamaha.webp",
                "title": "Piano digital compacto",
                "subtitle": "Yamaha P-45",
                "price": 1850000,
                "installments": 3,
                "installment_price": 616666,
                "category": "pianos",
                "brand": "Yamaha",
                "on_sale": true,
                "discount": 10
            },
            {
                "id": 8,
                "image": "images/piano-casio.webp",
                "title": "Piano digital profesional",
                "subtitle": "Casio Privia PX-160",
                "price": 2100000,
                "installments": 3,
                "installment_price": 700000,
                "category": "pianos",
                "brand": "Casio",
                "on_sale": false,
                "discount": 0
            },
            {
                "id": 9,
                "image": "images/clarinete-1.webp",
                "title": "Clarinete Sib estudio",
                "subtitle": "Yamaha YCL-255",
                "price": 950000,
                "installments": 3,
                "installment_price": 316666,
                "category": "vientos",
                "brand": "Yamaha",
                "on_sale": true,
                "discount": 12
            },
            {
                "id": 10,
                "image": "images/clarinete-2.webp",
                "title": "Clarinete profesional",
                "subtitle": "Buffet Crampon E11",
                "price": 1450000,
                "installments": 3,
                "installment_price": 483333,
                "category": "vientos",
                "brand": "Buffet",
                "on_sale": false,
                "discount": 0
            },
            {
                "id": 11,
                "image": "images/auricular-1.webp",
                "title": "Auriculares de estudio",
                "subtitle": "Audio-Technica ATH-M20X",
                "price": 180000,
                "installments": 3,
                "installment_price": 60000,
                "category": "audio",
                "brand": "Audio-Technica",
                "on_sale": true,
                "discount": 20
            },
            {
                "id": 12,
                "image": "images/auricular-2.webp",
                "title": "Auriculares profesionales",
                "subtitle": "Sony MDR-7506",
                "price": 250000,
                "installments": 3,
                "installment_price": 83333,
                "category": "audio",
                "brand": "Sony",
                "on_sale": false,
                "discount": 0
            },
            {
                "id": 13,
                "image": "images/atril-1.webp",
                "title": "Atril plegable",
                "subtitle": "Hamilton KB100",
                "price": 45000,
                "installments": 3,
                "installment_price": 15000,
                "category": "accesorios",
                "brand": "Hamilton",
                "on_sale": true,
                "discount": 5
            },
            {
                "id": 14,
                "image": "images/atril-2.webp",
                "title": "Atril reforzado",
                "subtitle": "K&M 101",
                "price": 65000,
                "installments": 3,
                "installment_price": 21666,
                "category": "accesorios",
                "brand": "K&M",
                "on_sale": false,
                "discount": 0
            },
            {
                "id": 15,
                "image": "images/flauta-1.webp",
                "title": "Flauta traversa estudio",
                "subtitle": "Yamaha YFL-222",
                "price": 780000,
                "installments": 3,
                "installment_price": 260000,
                "category": "vientos",
                "brand": "Yamaha",
                "on_sale": true,
                "discount": 8
            },
            {
                "id": 16,
                "image": "images/flauta-2.webp",
                "title": "Flauta traversa profesional",
                "subtitle": "Gemeinhardt 2SP",
                "price": 1100000,
                "installments": 3,
                "installment_price": 366666,
                "category": "vientos",
                "brand": "Gemeinhardt",
                "on_sale": false,
                "discount": 0
            },
            {
                "id": 17,
                "image": "images/bajo-1.webp",
                "title": "Bajo eléctrico activo",
                "subtitle": "Ibanez GSR200",
                "price": 890000,
                "installments": 3,
                "installment_price": 296666,
                "category": "bajos",
                "brand": "Ibanez",
                "on_sale": true,
                "discount": 15
            },
            {
                "id": 18,
                "image": "images/bajo-2.webp",
                "title": "Bajo eléctrico clásico",
                "subtitle": "Fender Precision Bass",
                "price": 1600000,
                "installments": 3,
                "installment_price": 533333,
                "category": "bajos",
                "brand": "Fender",
                "on_sale": false,
                "discount": 0
            },
            {
                "id": 19,
                "image": "images/microfono-1.webp",
                "title": "Micrófono dinámico",
                "subtitle": "Shure SM58",
                "price": 320000,
                "installments": 3,
                "installment_price": 106666,
                "category": "audio",
                "brand": "Shure",
                "on_sale": true,
                "discount": 10
            },
            {
                "id": 20,
                "image": "images/microfono-2.webp",
                "title": "Micrófono condensador",
                "subtitle": "AKG P120",
                "price": 210000,
                "installments": 3,
                "installment_price": 70000,
                "category": "audio",
                "brand": "AKG",
                "on_sale": false,
                "discount": 0
            },
            {
                "id": 21,
                "image": "images/teclado-1.webp",
                "title": "Teclado portátil",
                "subtitle": "Casio CTK-3500",
                "price": 480000,
                "installments": 3,
                "installment_price": 160000,
                "category": "pianos",
                "brand": "Casio",
                "on_sale": true,
                "discount": 18
            },
            {
                "id": 22,
                "image": "images/teclado-2.webp",
                "title": "Teclado profesional",
                "subtitle": "Yamaha PSR-E373",
                "price": 620000,
                "installments": 3,
                "installment_price": 206666,
                "category": "pianos",
                "brand": "Yamaha",
                "on_sale": false,
                "discount": 0
            }]';

        $products = json_decode($json, true);
        return view('pages.catalog', compact('products'));
    }

    public function details(){
        return view('pages.product-details');
    }
}
