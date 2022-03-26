<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses;


class ExpensesController extends Controller
{
    public function getAllExpenses(){
        $expenses = Expenses::orderBy('created_at', 'DESC')->get()->toJson(JSON_PRETTY_PRINT);
        return response($expenses, 200);
    }

     public function createExpense(Request $request){
         $expense = new Expenses;
         $expense->description = strval($request->description);
         $expense->transaction_at = $request->transaction_at;
         $expense->user_name = strval($request->user_name);
         $expense->value = $request->value;
         $expense->save();

         return response()->json([
             "mensagem" => "expense record created!"
         ], 201);
     }
    
     public function getExpense($id){
        if (Expenses::where('id', $id)->exists()) {
            $expense = Expenses::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($expense, 200);
        }else{
            return response()->json([
                "message" => "Expense not found"
            ], 404);
        }
    }

    public function updateExpense(Request $request, $id){
        if (Expenses::where('id', $id)->exists()) {
            $expense = Expenses::find($id);
            $expense->description = is_null($request->description) ? $expense->description : $request->description;
            $expense->transaction_at = is_null($request->transaction_at) ? $expense->transaction_at : $request->transaction_at;
            $expense->user_name = is_null($request->user_name) ? $expense->user_name : $request->user_name;
            $expense->value = is_null($request->value) ? $expense->value : $request->value;
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "Expense not found"
            ], 404);
            
        }
    }

    public function deleteExpense($id){
        if(Expenses::where('id', $id)->exists()) {
            $expense = Expenses::find($id);
            $expense->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
            } else {
            return response()->json([
                "message" => "Expense not found"
            ], 404);
        }
    }
}
