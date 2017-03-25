<?php
    require_once('connection.php');
    session_start();
    
    // Compatibility checks:
    $errors = [];
    $i = 0;
    // Check to make sure atleast one of each part is selected
    if (!allComponentsSelected()) {
        $errors[$i] = "One or more components not selected";
        $i++;
        header("Location: index.php");
    }
    // CPU.socket  == Motherboard.socketType
    if (socketMismatch()) {
        $errors[$i] = "Motherboard and CPU have different socket types";
        $i++;
    }
    // RAM.type == Motherboard.ramType
    
    // Total ram size <= motherboard max ram 
    
    // Motherboard form factor <= case’s allowed mb form factor
    
    // GPU length <= cases max gpu length
    
    // Total TDP <= PSU.watts (warning if within 50 watts)
  
    $_SESSION["errors"] = $errors;
    header("Location: index.php");
  function allComponentsSelected(){
      if ($_SESSION["cpuSelected"] == NULL){
          return false;
      }
      if ($_SESSION["mbSelected"] == NULL){
          return false;
      }
      if ($_SESSION["ramSelected"] == NULL){
          return false;
      }
      if ($_SESSION["storageSelected"] == NULL){
          return false;
      }
      if ($_SESSION["gpuSelected"] == NULL){
          return false;
      }
      if ($_SESSION["caseSelected"] == NULL){
          return false;
      }
      if ($_SESSION["psuSelected"] == NULL){
          return false;
      }
      return true;
  }
  
  function socketMismatch() {
      if (strcmp($_SESSION["cpuSelected"]["cpuSocketId"] , $_SESSION["mbSelected"]["mbSocketId"]) == 0) {
          return false;
      } 
      return true;
  }
?>