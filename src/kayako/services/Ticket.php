<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\services;

use indigerd\kayako\models\Ticket as TicketModel;

class Ticket extends BaseService
{
    protected $collectionTag = 'tickets';
    protected $modelClas = TicketModel::class;

    public function create(array $data = [])
    {

    }

    public function update($id, array $data = [])
    {

    }

    public function attachFiles($id, array $files = [])
    {

    }

    public function addPost($id, array $data = [])
    {

    }

    public function getTicket($id)
    {
        // path /Tickets/Ticket/$ticketid$/
        $path = '/Tickets/Ticket/' . (int)$id . '/';
        $data = $this->get($path);
        return $this->parseResponse($data);
    }

    public function getTickets(array $params = [])
    {
        // path /Tickets/Ticket/ListAll/$departmentid$/$ticketstatusid$/$ownerstaffid$/$userid$/$count$/$start$/$sortField$/$sortOrder$
        $defaults = [
            'departmentid' => -1,
            'ticketstatusid' => -1,
            'ownerstaffid' => -1,
            'userid' => -1,
            'count' => -1,
            'start' => -1,
            'sortField' => 'ticketid',
            'sortOrder' => 'ASC'
        ];

        $a = array_intersect_key($params, $defaults);
        $p = array_merge($defaults, $a);
        $path = '/Tickets/Ticket/ListAll/' . implode('/', $p) . '/';
        $data = $this->get($path);
        return $this->parseResponse($data);
    }
}
