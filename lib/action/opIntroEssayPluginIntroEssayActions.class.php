<?php

/**
 * introessay actions.
 *
 * @package    OpenPNE
 * @subpackage introessay
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class opIntroEssayPluginIntroEssayActions extends sfActions
{
 /**
  * Executes first time
  */
  public function preExecute()
  {
    if(!$this->hasRequestParameter('id')) $this->forward404Unless( NULL, 'Undefined id.');
    $this->id = $this->getRequestParameter('id', $this->getUser()->getMemberId());
    $this->member = MemberPeer::retrieveByPk($this->id);
    $this->forward404Unless($this->member, 'Undefined member.');
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex($request)
  {
    $this->introEssay = IntroEssayPeer::getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
    $this->form = new IntroEssayForm($this->introEssay);
    if ($request->isMethod('post'))
    {
      $array = $request->getParameter('intro_essay');
      if (!$this->introEssay)
      {
        $array['from_id'] = $this->getUser()->GetMemberId();
        $array['to_id'] = $this->id;
      }
      $this->form->bind($array);
      if ($this->form->isValid())
      {
        if ($this->introEssay)
        {
          $this->introEssay->setContent($array['content']);
          $this->introEssay->save();
        }
        else
        {
          $this->form->save();
        }
        return sfView::SUCCESS;
      }
    }
    return sfView::INPUT;
  }

 /**
  * Executes delete action
  *
  * @param sfRequest $request A request object
  */
  public function executeDelete($request)
  {
    $this->introEssay = IntroEssayPeer::getByFromAndTo($this->getUser()->GetMemberId(), $this->id);
    $this->forward404Unless($this->introEssay, 'Undefined member.');
    if ($request->isMethod('post'))
    {
      if ($request->hasParameter('delete'))
      {
        if (isset($this->introEssay)) $this->introEssay->delete();
      }
      $this->redirect('member/' . $this->id);
    }
  }
}