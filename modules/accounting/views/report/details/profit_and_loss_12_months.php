<div id="accordion">
  <div class="card">
    <table class="tree">
      <thead>
      </thead>
      <tbody>
        <tr class="treegrid-01 parent-node expanded">
          <td colspan="14">
              <h3 class="text-center no-margin-top-20 no-margin-left-24"><?php echo get_option('companyname'); ?></h3>
          </td>
          <td></td>
          <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);

            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
        </tr>
        <tr class="treegrid-02 parent-node expanded">
          <td colspan="14">
            <h4 class="text-center no-margin-top-20 no-margin-left-24"><?php echo _l('profit_and_loss_12_months'); ?></h4>
          </td>
          <td></td>
          <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
        </tr>
        <tr class="treegrid-03 parent-node expanded">
          <td colspan="14">
            <p class="text-center no-margin-top-20 no-margin-left-24"><?php echo _d($data_report['from_date']) .' - '. _d($data_report['to_date']); ?></p>
          </td>
          <td></td>
          <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
        </tr>
        <tr>
          <td>
          </td>
          <td></td>
          <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
        </tr>
        <tr class="tr_header">
          <td></td>
          <?php 
          $start = $month = strtotime($data_report['from_date']);
          $end = strtotime($data_report['to_date']);
          while($month <= $end)
          {
            echo '<td class="th_total_width_auto text-bold">'.date('F', $month).'<br>'.date('Y', $month).'</td>';
              $month = strtotime("+1 month", $month);
          }
          ?>
          <td class="th_total_width_auto text-bold"><?php echo _l('total'); ?></td>
        </tr>
        <?php
          $row_index = 0;
          $parent_index = 0;
          $row_index += 1;
          $parent_index = $row_index;
          ?>
          <tr class="treegrid-<?php echo html_entity_decode($parent_index); ?> parent-node expanded">
            <td class="parent"><?php echo _l('acc_income'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td class="total_amount"></td>
          </tr>
          <?php
          $row_index += 1;
          ?>
          <?php 
            $_index = $row_index;
            $data = $this->accounting_model->get_html_profit_and_loss_12_months($data_report['data']['income'], ['html' => '', 'row_index' => $row_index + 1, 'total_amount' => 0, 'total_py_amount' => 0], $parent_index, $currency);
            $row_index = $data['row_index'];
            echo html_entity_decode($data['html']);
            $total_income = $data['total_amount'];

            ?>
          <?php $row_index += 1; ?>
          <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> treegrid-parent-<?php echo html_entity_decode($parent_index); ?> parent-node expanded tr_total">
            <td class="parent"><?php echo _l('total_income'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td class="total_amount"><?php echo app_format_money($total_income, $currency->name); ?> </td>
          </tr>
          <?php $row_index += 1;
            $parent_index = $row_index;
          ?>
           <tr class="treegrid-<?php echo html_entity_decode($parent_index); ?> parent-node expanded">
            <td class="parent"><?php echo _l('acc_cost_of_sales'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td></td>

          </tr>
          <?php 
          $data = $this->accounting_model->get_html_profit_and_loss_12_months($data_report['data']['cost_of_sales'], ['html' => '', 'row_index' => $row_index + 1, 'total_amount' => 0, 'total_py_amount' => 0], $parent_index, $currency);
            $row_index = $data['row_index'];
            echo html_entity_decode($data['html']);
            $total_cost_of_sales = $data['total_amount'];
           ?>
          <?php $row_index += 1; ?>
          <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> treegrid-parent-<?php echo html_entity_decode($parent_index); ?> parent-node expanded tr_total">
            <td class="parent"><?php echo _l('total_cost_of_sales'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td class="total_amount"><?php echo app_format_money($total_cost_of_sales, $currency->name); ?> </td>
          </tr>
          <?php $row_index += 1; ?>
          <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> parent-node expanded tr_total">
            <td class="parent"><?php echo _l('gross_profit_uppercase'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td class="total_amount"><?php echo app_format_money($total_income - $total_cost_of_sales, $currency->name); ?> </td>
          </tr>
          <?php $row_index += 1;
            $parent_index = $row_index;
          ?>
          <tr class="treegrid-<?php echo html_entity_decode($parent_index); ?> parent-node expanded">
            <td class="parent"><?php echo _l('acc_other_income'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td></td>
          </tr>
          <?php 
            $data = $this->accounting_model->get_html_profit_and_loss_12_months($data_report['data']['other_income'], ['html' => '', 'row_index' => $row_index + 1, 'total_amount' => 0, 'total_py_amount' => 0], $parent_index, $currency);
            $row_index = $data['row_index'];
            echo html_entity_decode($data['html']);
            $total_other_income = $data['total_amount'];

           ?>
          <?php $row_index += 1; ?>
          <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> treegrid-parent-<?php echo html_entity_decode($parent_index); ?> parent-node expanded tr_total">
            <td class="parent"><?php echo _l('total_other_income_loss'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td class="total_amount"><?php echo app_format_money($total_other_income, $currency->name); ?> </td>
          </tr>
          <?php $row_index += 1;
            $parent_index = $row_index;
          ?>
          <tr class="treegrid-<?php echo html_entity_decode($parent_index); ?> parent-node expanded">
            <td class="parent"><?php echo _l('acc_expenses'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td></td>
          </tr>
          <?php 
          $data = $this->accounting_model->get_html_profit_and_loss_12_months($data_report['data']['expenses'], ['html' => '', 'row_index' => $row_index + 1, 'total_amount' => 0, 'total_py_amount' => 0], $parent_index, $currency);
            $row_index = $data['row_index'];
            echo html_entity_decode($data['html']);
            $total_expenses = $data['total_amount'];

           ?>
          <?php $row_index += 1; ?>
          <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> treegrid-parent-<?php echo html_entity_decode($parent_index); ?> parent-node expanded tr_total">
            <td class="parent"><?php echo _l('total_expenses'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td class="total_amount"><?php echo app_format_money($total_expenses, $currency->name); ?> </td>
          </tr>
          <?php $row_index += 1;
            $parent_index = $row_index;
          ?>
          <tr class="treegrid-<?php echo html_entity_decode($parent_index); ?> parent-node expanded">
            <td class="parent"><?php echo _l('acc_other_expenses'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td></td>
          </tr>
          <?php 
          $data = $this->accounting_model->get_html_profit_and_loss_12_months($data_report['data']['other_expenses'], ['html' => '', 'row_index' => $row_index + 1, 'total_amount' => 0, 'total_py_amount' => 0], $parent_index, $currency);
            $row_index = $data['row_index'];
            echo html_entity_decode($data['html']);
            $total_other_expenses = $data['total_amount'];
            
            $row_index += 1;
          ?>
          <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> treegrid-parent-<?php echo html_entity_decode($parent_index); ?> parent-node expanded tr_total">
            <td class="parent"><?php echo _l('total_other_expenses'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td class="total_amount"><?php echo app_format_money($total_other_expenses, $currency->name); ?> </td>
          </tr>
          <?php $row_index += 1; ?>
          <tr class="treegrid-total-<?php echo html_entity_decode($row_index); ?> parent-node expanded tr_total">
            <td class="parent"><?php echo _l('net_earnings_uppercase'); ?></td>
            <?php 
            $start = $month = strtotime($data_report['from_date']);
            $end = strtotime($data_report['to_date']);
            while($month <= $end)
            {
              echo '<td></td>';
                $month = strtotime("+1 month", $month);
            }
            ?>
            <td class="total_amount"><?php echo app_format_money(($total_income + $total_other_income) - ($total_cost_of_sales + $total_expenses + $total_other_expenses), $currency->name); ?> </td>
          </tr>
        </tbody>
    </table>
  </div>
</div>