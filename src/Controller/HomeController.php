<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Core\Http\Response;
use Core\Repository\Repository;

class HomeController extends \Core\Controller\Controller
{

    public function index():Response
    {
        $pizzaRepository = new PizzaRepository();
        $pizza = new Pizza();
        $pizza->setId(1);
        $pizza->setName("4 fromages");
        $pizza->setDescription("Plein de fromage");
        $pizzaRepository->save($pizza);

        return $this->render("home/index", [
            "pageTitle"=> "Welcome to the framework"
        ]);
    }




}