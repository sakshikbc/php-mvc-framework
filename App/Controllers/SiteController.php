<?php

namespace MVC\App\Controllers;

use MVC\Core\Request;
use MVC\Core\Response;
use MVC\Core\Controller;
use MVC\Core\Application;
use MVC\App\Models\ContactForm;

class SiteController extends Controller
{
    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if($request->isPost() ) {
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks For Contacting Us');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }

    public function home()
    {
        $params = [
            'name' => "Sakshi Kbc"
        ];
        return $this->render('home', $params);
        // return Application::$app->router->renderView('home', $params);
        // return \view('contact');
    }


    
}