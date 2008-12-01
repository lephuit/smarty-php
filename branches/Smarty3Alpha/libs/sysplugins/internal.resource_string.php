<?php

/**
* Smarty Internal Plugin Resource String
* 
* Implements the strings as resource for Smarty template
* @package Smarty
* @subpackage TemplateResources
* @author Uwe Tews
*/
/**
* Smarty Internal Plugin Resource String
*/

class Smarty_Internal_Resource_String extends Smarty_Internal_Base {

    /**
    * Get filepath to template source
    * 
    * @param object $_template template object
    * @return string return 'string' as template source is not a file
    */
    public function getTemplateFilepath($_template)
    {
        // no filepath for strings
        // return "string" for compiler error messages
        return 'string';
    }

    /**
    * Get timestamp to template source
    * 
    * @param object $_template template object
    * @return boolean false as string resources have no timestamp
    */
    public function getTemplateTimestamp($_template)
    {    
         // strings must always be compiled and have no timestamp
         return false;
    } 

    /**
    * Retuen template source from resource name
    * 
    * @param object $_template template object
    * @return string content of template source
    */
    public function getTemplateSource($_template)
    { 
        // return template string
        $_template->template_source = $_template->resource_name;
        return  true;
   }
    
    /**
    * Return flag that this resource uses the compiler
    * 
    * @return boolean true
    */
    public function usesCompiler()
    { 
        // resource string is template, needs compiler
        return true;
    }
    
    /**
    * Return flag that this resource is evaluated
    * 
    * @return boolean true
    */
    public function isEvaluated()
    { 
        // compiled template is evaluated instead of saved to disk
        return true;
    } 
     
    /**
    * Get filepath to compiled template
    * 
    * @param object $_template template object
    * @return boolean return false as compiled template is not stored
    */
    public function getCompiledFilepath($_template)
    {
        // no filepath for strings
        return false;
    }
} 

?>
