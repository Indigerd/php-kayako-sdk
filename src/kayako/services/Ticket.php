<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\services;

use indigerd\kayako\models\Ticket as TicketModel;
use indigerd\kayako\models\TicketAttachment;
use indigerd\kayako\models\Post;

class Ticket extends BaseService
{
    public function create(array $params = [])
    {
        // path /Tickets/Ticket
        $path = '/Tickets/Ticket';
        $data = $this->post($path, $params);
        return $this->parseResponse($data, 'tickets', TicketModel::class);
    }

    public function update($id, array $params = [])
    {
        // path /Tickets/Ticket/$ticketid$/
        $path = '/Tickets/Ticket/' . (int)$id . '/';
        $data = $this->put($path, $params);
        return $this->parseResponse($data, 'tickets', TicketModel::class);
    }

    public function attachFiles($id, $postId, array $files = [])
    {
        // path /Tickets/TicketAttachment
        $path = '/Tickets/TicketAttachment';
        $result = [];
        foreach ($files as $fileName => $location) {
            $params = [
                'ticketid' => $id,
                'ticketpostid' => $postId,
                'filename' => basename($fileName),
                'contents' => base64_encode(file_get_contents($location))
            ];
            $data = $this->post($path, $params);
            $result[] = $this->parseResponse($data, 'attachments', TicketAttachment::class);
        }
        return $result;
    }

    public function getAttachments($id)
    {
        // path /Tickets/TicketAttachment/ListAll/$ticketid$
        $path = '/Tickets/TicketAttachment/ListAll/' . (int)$id;
        $data = $this->get($path);
        return $this->parseResponse($data, 'attachments', TicketAttachment::class);
    }

    public function getAttachment($id, $attachmentId)
    {
        // path /Tickets/TicketAttachment/$ticketid$/$id$
        $path = '/Tickets/TicketAttachment/' . (int)$id . '/' . (int)$attachmentId;
        $data = $this->get($path);
        return $this->parseResponse($data, 'attachments', TicketAttachment::class);
    }

    public function addPost($id, array $params = [])
    {
        // path /Tickets/TicketPost
        $path = '/Tickets/TicketPost';
        $params['ticketid'] = $id;
        $data = $this->post($path, $params);
        return $this->parseResponse($data, 'posts', Post::class);
    }

    public function getTicket($id)
    {
        // path /Tickets/Ticket/$ticketid$/
        $path = '/Tickets/Ticket/' . (int)$id . '/';
        $data = $this->get($path);
        return $this->parseResponse($data, 'tickets', TicketModel::class);
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
        echo $data;exit;
        return $this->parseResponse($data, 'tickets', TicketModel::class);
    }
}
