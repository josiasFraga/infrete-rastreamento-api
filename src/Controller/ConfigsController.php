<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Configs Controller
 *
 * @method \App\Model\Entity\Config[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConfigsController extends AppController
{

    /**
     * View method
     *
     * @param string|null $id Config id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $key = $this->request->getQuery('key');
        $value = $this->Configs->find('all')->where([
            'Configs.key' => $key
        ])->first();

        if ( !$value ) {

            return $this->response->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'ok',
                    'data' => ''
                ]));
        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'ok',
                'data' => $value->value
            ]));
    }


    /**
     * Edit method
     *
     * @param string|null $id Config id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($key = null)
    {
        
        $jwtPayload = $this->request->getAttribute('jwtPayload');

        $this->loadModel('Usuarios');

        $usuario = $this->Usuarios->find('all')->where(['id' =>  $jwtPayload->sub])->first();

        if ( !$usuario || $usuario['nivel'] != 'admin' ) {

            return $this->response->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'erro',
                    'msg' => 'Sem permissão de acesso!'
                ]));

        }

        $config = $this->Configs->find('all')->where([
            'Configs.key' => $key
        ])->first();

        $dados = json_decode($this->request->getData('dados'), true);
        $config->value = $dados['whatsapp'];    
    
        if ($this->Configs->save($config)) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'ok',
                    'msg' => 'Configurações alteradas com sucesso!'
                ]));

        }

        return $this->response->withType('application/json')
        ->withStringBody(json_encode([
            'status' => 'erro',
            'msg' => 'Ocorreu um erro ao salvar as configurações!'
        ]));
    }


}
