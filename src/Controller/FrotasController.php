<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Http\Response;


/**
 * Frotas Controller
 *
 * @property \App\Model\Table\FrotasTable $Frotas
 * @method \App\Model\Entity\Frota[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FrotasController extends AppController
{
    
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
 

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $jwtPayload = $this->request->getAttribute('jwtPayload');
        //debug($jwtPayload->sub);
        //die();
        $frotas = $this->Frotas->find('all')->contain('Usuarios')->where([
            'Frotas.usuario_id' => $jwtPayload->sub
        ]);

        $this->set([
            'data' => $frotas,
            '_serialize' => ['data']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Frota id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $frota = $this->Frotas->get($id, [
            'contain' => ['Usuarios', 'Traces'],
        ]);

        $this->set(compact('frota'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post', 'put']);
        
        $jwtPayload = $this->request->getAttribute('jwtPayload');

        $this->loadModel('Usuarios');

        $usuario = $this->Usuarios->find('all')->where(['id' =>  $jwtPayload->sub])->first();

        if ( !$usuario || $usuario['nivel'] != 'admin' ) {
    
            $message = 'Sem permissão de acesso';
            $status = 'erro';

        } else {

            $frota = $this->Frotas->newEmptyEntity();
            $frota = $this->Frotas->patchEntity($frota, json_decode($this->request->getData('dados'), true));
        
            if ($this->Frotas->save($frota)) {
                $message = 'Saved';
                $status = 'ok';
            } else {
                $message = 'Error';
                $status = 'erro';
            }

        }
    
        $this->set([
            'message' => $message,
            'status' => $status
        ]);
    
        $this->viewBuilder()->setOption('serialize', ['message', 'status']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Frota id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        $jwtPayload = $this->request->getAttribute('jwtPayload');

        $this->loadModel('Usuarios');

        $usuario = $this->Usuarios->find('all')->where(['id' =>  $jwtPayload->sub])->first();

        if ( !$usuario || $usuario['nivel'] != 'admin' ) {
    
            $message = 'Sem permissão de acesso';
            $status = 'erro';

        } else {
        
            $frota = $this->Frotas->get($id, [
                'contain' => [],
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $frota = $this->Frotas->patchEntity($frota, json_decode($this->request->getData('dados'), true));
       
            }
        
            if ($this->Frotas->save($frota)) {
                $message = 'Saved';
                $status = 'ok';
            } else {
                $message = 'Error';
                $status = 'erro';
            }

        }
    
        $this->set([
            'message' => $message,
            'status' => $status
        ]);
    
        $this->viewBuilder()->setOption('serialize', ['message', 'status']);
    
    }

    /**
     * Delete method
     *
     * @param string|null $id Frota id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $jwtPayload = $this->request->getAttribute('jwtPayload');

        $this->loadModel('Usuarios');

        $usuario = $this->Usuarios->find('all')->where(['id' =>  $jwtPayload->sub])->first();

        if ( !$usuario || $usuario['nivel'] != 'admin' ) {
    
            $message = 'Sem permissão de acesso';
            $status = 'erro';

        } else {
            $frota = $this->Frotas->get($id);
            if ($this->Frotas->delete($frota)) {
                $message = 'Deleted';
                $status = 'ok';
            } else {
                $message = 'Error';
                $status = 'erro';
            }
        }
    
        $this->set([
            'message' => $message,
            'status' => $status
        ]);
    
        $this->viewBuilder()->setOption('serialize', ['message', 'status']);
    }
}
