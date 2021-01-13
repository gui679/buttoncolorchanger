<?php
class GuilhermeMedeiros_ButtonColorChanger_Block_Css extends Mage_Core_Block_Template
{
    public function ruleColor()
    {
        Mage::log('rule color',null, 'debug_aquele.log', true);
        $now = Varien_Date::toTimestamp(Mage::getModel('core/date')->gmtDate());
        $rules = Mage::getModel('buttoncolorchanger/rule')->getCollection();
        $rules->getSelect()->where("type = 1");
        foreach ($rules as $rule) {
            $from = Varien_Date::toTimestamp($rule->getDateFrom());
            $to = Varien_Date::toTimestamp($rule->getDateTo());            
            if ($from < $now  && $to > $now) {
                return $rule->getColor();
            }
        }
        $rules = Mage::getModel('buttoncolorchanger/rule')->getCollection();
        $rules->getSelect()->where("type = 2");
        foreach ($rules as $rule) {
            $days_week = explode(",", $rule->getDayWeek());
            $today = date('w', Varien_Date::toTimestamp(Mage::getModel('core/date')->gmtDate()));
            foreach($days_week as $day){
                if($day == $today){
                    return $rule->getColor();
                }
            }
            
        }
        return null;
    }
}
