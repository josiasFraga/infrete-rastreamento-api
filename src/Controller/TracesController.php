<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Traces Controller
 *
 * @property \App\Model\Table\TracesTable $Traces
 * @method \App\Model\Entity\Trace[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TracesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $jwtPayload = $this->request->getAttribute('jwtPayload');
        $frota_id = $this->request->getQuery('frota_id');

        $traces = $this->Traces->find('all')->contain('Frotas')->where([
            'Frotas.id' => $frota_id,
            'Frotas.usuario_id' => $jwtPayload->sub
        ]);

        $this->set([
            'data' => $traces,
            '_serialize' => ['data']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Trace id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $trace = $this->Traces->get($id, [
            'contain' => ['Frotas'],
        ]);

        $this->set(compact('trace'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $trace = $this->Traces->newEmptyEntity();
        if ($this->request->is('post')) {
            $trace = $this->Traces->patchEntity($trace, $this->request->getData());
            if ($this->Traces->save($trace)) {
                $this->Flash->success(__('The trace has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The trace could not be saved. Please, try again.'));
        }
        $frotas = $this->Traces->Frotas->find('list', ['limit' => 200])->all();
        $this->set(compact('trace', 'frotas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Trace id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $trace = $this->Traces->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $trace = $this->Traces->patchEntity($trace, $this->request->getData());
            if ($this->Traces->save($trace)) {
                $this->Flash->success(__('The trace has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The trace could not be saved. Please, try again.'));
        }
        $frotas = $this->Traces->Frotas->find('list', ['limit' => 200])->all();
        $this->set(compact('trace', 'frotas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Trace id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $trace = $this->Traces->get($id);
        if ($this->Traces->delete($trace)) {
            $this->Flash->success(__('The trace has been deleted.'));
        } else {
            $this->Flash->error(__('The trace could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
