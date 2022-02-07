<?php

namespace App\Controllers;
use \App\Models\ContracteModel as ContracteModel;
use \App\Entities\Contracte as Entitie;
class Contracte extends BaseController
{
    private $model;
    private $model_phone;
    public $_filter_url = '/filter';
    public $fields_filter = array(
        'type'     => false,
        'search'   => false,
        'rows'     => false,
        'sortby'   => false
    );
    public $_tabel_header = [
        array(
            'th' => 'ID',
            'row' => 'id|ASC',
            'url' => '/filter?sortby=id|ASC',
            'active' => false
        ),
        array(
            'th' => 'Nume',
            'row' => 'nume|ASC',
            'url' => '/filter?sortby=nume|ASC',
            'active' => false
        ),
        array(
            'th' => 'Sex',
            'row' => 'sex|ASC',
            'url' => '/filter?sortby=sex|ASC',
            'active' => false
        ),
        array(
            'th'  => 'CNP',
            'row' => 'cnp|ASC',
            'url' => '/filter?sortby=cnp|ASC',
            'active' => false
        ),
        array(
            'th' => 'E-mail',
            'row' => 'email|ASC',
            'url' => '/filter?sortby=email|ASC',
            'active' => false
        ),
        array(
            'th' => 'Data de nastere',
            'row' => 'data|ASC',
            'url' => '/filter?sortby=data|ASC',
            'active' => false
        ),
        array(
            'th' => 'Adaugat',
            'row' => '',
            'url' => ''
        ),
        array(
            'th' => 'Modificat',
            'row' => '',
            'url' => ''
        ),
        array(
            'th' => 'Telefon',
            'row' => 'tel|ASC',
            'url' => '/filter?sortby=tel|ASC',
            'active' => false
        ),
        array(
            'th' => 'Editeaza',             
        ),
        array(
            'th' => 'Sterge',
        ),
        array(
            'cancel' => 'Anuleaza',
            'url' => ''
        )   
    ];
    public $rows = [
        array(
            'row' => 1,
            'url' => '/filter?rows=1'
        ), 
        array(
            'row' => 5,
            'url' => '/filter?rows=5'
        ), 
        array(
            'row' => 10,
            'url' => '/filter?rows=10'
        ), 
        array(
            'row' => 15,
            'url' => '/filter?rows=15'
        ), 
        array(
            'cancel' => 'Anuleaza',
            'url' => ''
        )
    ];
    public function setRowUrl($_fields, $_fields_second, $rows = 'rows', $row = 'row', $cancel = 'cancel', $url = 'url')
    {
        if(
            ( count($_fields) == 1  ) && !empty($_fields[$rows] ) 
        ){
            return $_fields_second;
        }
        else{
            if(count($_fields) > 1 && !empty($_fields[$rows]) )
            {                 
                foreach($_fields_second as $k => $v)
                {
                    if(
                        empty($_fields_second[$k][$url]) && 
                        empty($_fields_second[$k][$cancel]) 
                    ){
                        continue;
                    }

                    $_fields_second[$k][$url] = '/filter' . '?';
                    $count = 1;
                    foreach($_fields as $key => $value)
                    {
                        if( !empty($v[$cancel]) && $key === $rows )
                        {
                            continue;
                        }

                        if($key === $rows){
                           if(!empty($_fields_second[$k][$row])){
                              $value = $_fields_second[$k][$row];
                           }
                        }
                        $_fields_second[$k][$url] .= ($count == 1 ? ( $key . '=' . $value ) : ( '&' . $key . '=' . $value ) );
                        $count++;
                    }
                }
            }
            else{
                foreach($_fields_second as $k => $v)
                {
                    if(
                        empty($_fields_second[$k][$url]) && 
                        empty($_fields_second[$k][$cancel]) 
                    ){
                        continue;
                    }

                    $_fields_second[$k][$url] = '/filter' . '?';
                    $count = 1;
                    foreach($_fields as $key => $value)
                    {
                      if(!empty($v[$row]))
                      {
                          $_fields_second[$k][$url] .= ($count == 1 ? ( $key . '=' . $value ) : ( '&' . $key . '=' . $value ) );
                          $count++;   
                      }
                    }
                    if(!empty($v[$row]))
                    {
                        $_fields_second[$k][$url] .= '&'. $rows . '=' . $v[$row];
                    }
                }
            }
        }

        return $_fields_second;
    }
    public function __construct()
    {
        $this->model = new ContracteModel;
        $this->getFieldsValue();
    }
    public function index()
    {
        helper('form');
        $result = $this->model->where('deleted', 0)->findAll(); 
        $result = $this->_unserialize($result);        
        return view('Contracte/index', array('result' => $result, 
                                             '_filter' => array(),
                                             'rows' => $this->rows,
                                             '_tabel_header' => $this->_tabel_header,
                                            )
                                      );
    }
    public function rows($id)
    {       
       helper('form');
       $result = $this->model->where('deleted', 0)->findAll($id); 
       $result = $this->_unserialize($result);
       return view('Contracte/index', array('result' => $result, 'rows' => $id));
    }
    public function setOrderByAscDesc()
    {
        $_sort = ['ASC', 'DESC'];

        foreach($this->fields_filter as $k => $v)
        {
           if( $k == 'sortby' )
           {
               $_parts = explode('|', $v);

               if(count($_parts) > 1 && in_array($_parts[1], $_sort) )
               {
                   foreach($this->_tabel_header as $key => $value)
                   {
                        $active = false;
                        if( !empty($value['row']) )
                        {
                            $_pieces = explode('|', $value['row']);
                            if(count($_pieces) > 1)
                            {
                                if($_pieces[0] == $_parts[0])
                                {
                                    $_pieces[1] = $_parts[1];

                                    $_pieces = implode('|', $_pieces);
                                    $this->_tabel_header[$key]['row'] = $_pieces;
                                    $_url = $this->_tabel_header[$key]['url'];
                                    if(!empty($_pieces))
                                    {
                                        $_url_pieces = (explode('|', $_url));
                                        if(count($_url_pieces) > 1)
                                        {
                                            $_url_pieces[1] = $_parts[1];
                                            $this->_tabel_header[$key]['url'] = implode('|', $_url_pieces);
                                            $active = true; 
                                        }
                                    }
                                }
                            }
                        }

                        if(isset($this->_tabel_header[$key]['active']))
                        {
                            $this->_tabel_header[$key]['active'] = $active;
                        }
                   }
               }
           }
        }
    }
    public function filter()
    {
        helper('form');         
        $_filter = $this->fields_filter;
        $result = $this->model;

        $this->setOrderByAscDesc();

        if( !empty($_filter['type']) && !empty($_filter['search']) )
        {
            $result = $result->like(array($_filter['type'] => $_filter['search']));
        }
        if(!empty($_filter['sortby']))
        {
            $_parts = explode('|',$_filter['sortby']);                      
            $result = $result->orderBy($_parts[0], (!empty($_parts[1]) ? $_parts[1] : 'ASC' ));
        }
        if(!empty($_filter['rows']) && is_numeric($_filter['rows']) )
        {
            $result = $result->where('deleted', 0)->findAll((int)$_filter['rows']);
        }
        else{
            $result = $result->where('deleted', 0)->findAll();
        }        
        if( !empty($result) && is_array($result) )
        {
            $result = $this->_unserialize($result);
        }


        $this->rows = $this->setRowUrl($this->fields_filter, $this->rows);
        $this->_tabel_header = $this->setRowUrl($this->fields_filter, $this->_tabel_header, 'sortby', 'row');         

        return view('Contracte/index',  array('result'  => $result, 
                                              '_filter' => $_filter,
                                              'rows' => $this->rows,
                                              '_tabel_header' => $this->_tabel_header,
                                        )
                    );
    }
    public function delete($id)
    {
        helper('form');
        $result = $this->isId($id);
        if(!empty($result))
        {
            $result->deleted = 1;             
            if($result->hasChanged())
            {
                $db_result = $this->model->save($result);
                if( !empty($this->model->errors()) ) 
                {
                    return redirect()->back()->to("/contracte")->with('success', 'Contractul a fost sters cu succes.');
                }
            }
             
        }
        $result = $this->model->where('deleted', 0)->findAll(); 
        $result = $this->_unserialize($result);
        return view('Contracte/index',  array('result'  => $result,
                                              'rows' => $this->rows,
                                              '_tabel_header' => $this->_tabel_header,
                                        )
                    );
    }
    public function create()
    {
        helper('form');
        $result = new Entitie;
        return view('Contracte/create', array('result' => $result ));
    }
    public function edit($id)
    {
        helper('form');
        $result = $this->isId($id);
        $result->tel = unserialize($result->tel);
        return view('Contracte/edit', array('result' => $result));
    }
    public function update($id)
    {
        if($this->isId($id))
        {
            $result = $this->model->find($id);
            $result = $result->fill($this->request->getPost());
            $result->tel = serialize($result->tel);
            if($result->hasChanged())
            {
                $db_result = $this->model->save($result);
                if($db_result) {
                    return redirect()->to("/contracte/edit/$id")->with('success', 'Contract modificat cu succes.');
                }
                else{
                    return redirect()->back()->with('errors', $this->model->errors())->withInput();
                }
            }
            return redirect()->to("/contracte/edit/$id")->with('info', 'Nu exista modificari pentru acest contract.');
        }
    }
    public function save()
    {
        $entitie = new Entitie($this->request->getPost());
        $entitie->tel = serialize($entitie->tel);      

        $this->model->insert($entitie);
        if(!empty($this->model->errors()))
        {
            return redirect()->back()->with('errors', $this->model->errors())->withInput();
        }
        return redirect()->to("/contracte")->with('success', 'Contractul a fost adaugat cu succes.');
    }
    public function _unserialize($list)
    {
        foreach($list as $key => $value)
        {
            $list[$key]->tel = unserialize($value->tel);
        }

        return $list;
    }
    public function isId($id) 
    {
        $result = $this->model->find($id);

        if(!$result)
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Contractul cu id-ul $id nu a fost gasit.");
        }
        return $result;
    }
    public function getFieldsValue() 
    { 
        foreach($this->fields_filter as $key => $value)
        {
            $this->fields_filter[$key] = ( !empty($_GET)  && !empty($_GET[$key])  ? $_GET[$key] : 
                                         ( !empty($_POST) && !empty($_POST[$key]) ? $_POST[$key] : $value ) );
            if($this->fields_filter[$key] === false)
            {
                unset($this->fields_filter[$key]);
            }
        } 
    }
}