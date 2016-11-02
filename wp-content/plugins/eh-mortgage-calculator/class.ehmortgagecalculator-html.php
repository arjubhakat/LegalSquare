<?php
/**
 * Create the html code to render the mortgage calculator,
 *  and the amortization table.
 *
 * @author edgar
 */
class EHMortgageCalculator_html {
    /**
     * html markup to render the mortgage calculator page
     * @var string html markup
     */
    protected $html;
    
    /**
     * html markup to render the mortgage calculator form
     * @var string html markup
     */
    protected $form;
    
    /**
     * html markup to render the amortization table
     * @var string html markup
     */
    protected $table;
    
    /**
     * Create the html code to render the Mortgage Calculator page.
     */
    public function __construct() {}
    
    public function getForm() {
        if(!$this->form) {
            $this->setForm();
        }
        return $this->form;
    }
    
    private function setForm() {
        $form = '<form>';
        $form.= '<div class="form-group" id="principal-group">';
        $form.= '<label class="control-label" for="principal">' . __('Loan amount:', 'eh-mortgage-calculator') . '</label>';
        $form.= '<input type="number" class="form-control" id="principal" min="10000" max="1000000" step="1000" value="" placeholder="' . __('Loan Amount', 'eh-mortgage-calculator') . '" autofocus/>';
        $form.= '<p class="hidden" id="principal-error">' . __('Please enter a loan amount, e.g. "40,000", "50,000.23"', 'eh-mortgage-calculator') . '</p>';
        $form.= '</div>';
        $form.= '<div class="form-group" id="interest-group">';
        $form.= '<label class="control-label" for="interest">' . __('Interest:', 'eh-mortgage-calculator') . '</label>';
        $form.= '<input type="number" class="form-control" id="interest" min="1" max="25" placeholder="' . __('Yearly Interest', 'eh-mortgage-calculator') . '"/>';
        $form.= '<p class="hidden" id="interest-error">' . __('Please enter a number between 1 and 25, e.g. "5", "5.5", "5.75"', 'eh-mortgage-calculator') . '</p>';
        $form.= '</div>';
        $form.= '<div class="form-group" id="term-group">';
        $form.= '<label class="control-label" for="term">' . __('Term:', 'eh-mortgage-calculator') . '</label>';
        $form.= '<input type="number" class="form-control" id="term" min="1" max="45" value="" placeholder="' . __('Number of years', 'eh-mortgage-calculator') . '"/>';
        $form.= '<p class="hidden" id="term-error">' . __('Please enter a number between 1 and 45: no decimals allowed', 'eh-mortgage-calculator') . '</p>';
        $form.= '</div>';
        $form.= '<div class="panel-footer text-center">';
        $form.= '<button type="button" class="btn btn-primary" id="submit" onclick="amortization();">' . __('Calculate', 'eh-mortgage-calculator') . '</button> ';
        $form.= '<button type="reset" class="btn btn-default" id="reset" onclick="resetForm();">' . __('Reset', 'eh-mortgage-calculator') . '</button>';
        $form.= '</div>';
        $form.= '</form>';
        
        $this->form = $form;
    }
    
    public function getTable() {
        if(!$this->table) {
            $this->setTable();
        }
        return $this->table;
    }
    
    private function setTable() {
        $table = '<table class="table table-striped">';
        $table.= '<thead>';
        $table.= '<tr>';
        $table.= '<th class="text-right">#</th>';
        $table.= '<th class="text-right">' . __('Payment', 'eh-mortgage-calculator') . '</th>';
        $table.= '<th class="text-right">' . __('Principal', 'eh-mortgage-calculator') . '</th>';
        $table.= '<th class="text-right">' . __('Interest', 'eh-mortgage-calculator') . '</th>';
        $table.= '<th class="text-right">' . __('Balance', 'eh-mortgage-calculator') . '</th>';
        $table.= '</tr>';
        $table.= '</thead>';
        $table.= '<tfoot>';
        $table.= '<tr>';
        $table.= '<td colspan="5">';
        $table.= '<nav class="text-center">';
        $table.= '<ul class="pagination" id="pagination"></ul>';
        $table.= '</nav>';
        $table.= '</td>';
        $table.= '</tfoot>';
        $table.= '<tbody id="amortization"></tbody>';
        $table.= '</table>';
        
        $this->table = $table;
    }
    
    public function getHTML() {
        if(!$this->html) {
            $this->setHTML();
        }
        return $this->html;
    }
    
    private function setHTML() {
        $html = $this->getForm();
        $html.= '<hr />';
        $html.= $this->getTable();
        

        $this->html = $html;
    }
}
