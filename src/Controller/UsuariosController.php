<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\View\JsonView;
/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuariosController extends AppController
{
    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    public function index()
    {
        $jwtPayload = $this->request->getAttribute('jwtPayload');

        $usuarios = $this->Usuarios->find('all')->contain('Frotas');

        $this->set([
            'data' => $usuarios,
            '_serialize' => ['data']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => ['Frotas'],
        ]);

        $this->set(compact('usuario'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post', 'put']);
        $usuario = $this->Usuarios->newEmptyEntity();
        $usuario = $this->Usuarios->patchEntity($usuario, json_decode($this->request->getData('dados'), true));
    
        if ($this->Usuarios->save($usuario)) {
            $message = 'Saved';
            $status = 'ok';
        } else {
            $message = 'Error';
            $status = 'erro';
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
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('The usuario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The usuario could not be saved. Please, try again.'));
        }
        $this->set(compact('usuario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuario = $this->Usuarios->get($id);
        if ($this->Usuarios->delete($usuario)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
    
        $this->set([
            'message' => $message
        ]);
        $this->viewBuilder()->setOption('serialize', ['message']);


    }
}
