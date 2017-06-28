<?php
/**
 * @author Alexander Stepanenko <alex.stepanenko@gmail.com>
 */

namespace indigerd\kayako\services;

use indigerd\kayako\models\TicketCustomField;
use indigerd\kayako\models\Ticket as TicketModel;
use indigerd\kayako\models\TicketAttachment;
use indigerd\kayako\models\TicketStatus;
use indigerd\kayako\models\Post;

class Ticket extends BaseService
{
    public function create(array $params = [])
    {
        // path /Tickets/Ticket
        $path = '/Tickets/Ticket';
        $data = $this->post($path, $params);
        //echo $data;exit;
        return $this->parseResponse($data, TicketModel::class);
    }

    public function update($id, array $params = [])
    {
        // path /Tickets/Ticket/$ticketid$/
        $path = '/Tickets/Ticket/' . (int)$id . '/';
        $data = $this->put($path, $params);
        return $this->parseResponse($data, TicketModel::class);
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
            //print_r($params);exit;
            $data = $this->post($path, $params);
            //echo $data;exit;
            $result[] = $this->parseResponse($data, TicketAttachment::class);
        }
        return $result;
    }

    public function getAttachments($id)
    {
        // path /Tickets/TicketAttachment/ListAll/$ticketid$
        $path = '/Tickets/TicketAttachment/ListAll/' . (int)$id;
        $data = $this->get($path);
        return $this->parseResponse($data, TicketAttachment::class, false);
    }

    public function getAttachment($id, $attachmentId)
    {
        // path /Tickets/TicketAttachment/$ticketid$/$id$
        $path = '/Tickets/TicketAttachment/' . (int)$id . '/' . (int)$attachmentId;
        $data = $this->get($path);
        return $this->parseResponse($data, TicketAttachment::class);
    }

    public function addPost($id, array $params = [])
    {
        // path /Tickets/TicketPost
        $path = '/Tickets/TicketPost';
        $params['ticketid'] = $id;
        $data = $this->post($path, $params);
        return $this->parseResponse($data, Post::class);
    }

    public function getTicket($id)
    {
        // path /Tickets/Ticket/$ticketid$/
        $path = '/Tickets/Ticket/' . (int)$id . '/';
        $data = $this->get($path);
        return $this->parseResponse($data, TicketModel::class);
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
        return $this->parseResponse($data, TicketModel::class, false);
    }

    public function getTicketStatuses()
    {
        // path /Tickets/TicketStatus
        $path = '/Tickets/TicketStatus';
        $data = $this->get($path);
        return $this->parseResponse($data, TicketStatus::class, false);
    }

    public function addCustomFields($id, array $fields = [])
    {
        // path /Tickets/TicketCustomField/$ticketid$
        $path = '/Tickets/TicketCustomField/' . (int)$id;
        $data = $this->post($path, $fields);
        //echo $data;exit;
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($data);
        $result = [];
        foreach ($xml as $child) {
            if ($child->children()) {
                foreach ($child as $subChild) {
                    $result[] = TicketCustomField::fromXml($subChild);
                }
            } else {
                $result[] = TicketCustomField::fromXml($child);
            }
        }
        return $result;
    }

    public function getTicketCustomFields($id)
    {
        // path /Tickets/TicketCustomField/$ticketid$
        $path = '/Tickets/TicketCustomField/' . (int)$id;
        $data = $this->get($path);
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($data);
        $result = [];
        foreach ($xml as $child) {
            if ($child->children()) {
                foreach ($child as $subChild) {
                    $result[] = TicketCustomField::fromXml($subChild);
                }
            } else {
                $result[] = TicketCustomField::fromXml($child);
            }
        }
        return $result;
    }
}
