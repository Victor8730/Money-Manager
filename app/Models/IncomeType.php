<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;


class IncomeType extends Model
{
    use HasFactory;

    /**
     * The name of the table in the database
     * @var string
     */
    protected $table = 'income_types';

    /**
     *  Indicates if the model has update and creation timestamps.
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     * Array of fields from the database
     * @var array|string[]
     */
    protected $fillable = [
        'name',
        'desc',
        'user_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Get income types from income
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incomes()
    {
        return $this->hasMany(Income::class, 'type_id');
    }

    /**
     * Return name type, with key id income type, by income
     * @param $incomes
     * @return array
     */
    public function getTypeNameByIncome(object $incomes): array
    {
        $name = [];

        foreach ($incomes as $income) {
            $income = Income::find($income->id);
            $name[$income->type->id] = $income->type->name;
        }

        return $name;
    }

    public function getTypeNameById(int $id)
    {
        return parent::firstWhere('id', $id)->name;
    }

    /**
     * Get all income type from user, in format object
     * @return object
     */
    public function getType(): object
    {
        return $this
            ->all()
            ->where('user_id', Auth::id());
    }

    /**
     * Get all income type from user, in format array with key by id
     * @return array
     */
    public function getTypeArray(): array
    {
        return $this
            ->all()
            ->where('user_id', Auth::id())
            ->keyBy('id')
            ->toArray();
    }

    /**
     * Delete income type, if exist associated income send error message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clean()
    {
        try {
            $this->delete();

            return redirect()->route('income-type.index')->with('success', 'Deletion completed successfully!');
        } catch (QueryException $e) {
            $incomeAssociated = IncomeType::find($this->id)->incomes;
            $listAssociated = view('errors.associated', ['ul' => $incomeAssociated, 'delete' => 'income']);

            return redirect()->route('income-type.index')->with('errors', 'The type of income cannot be deleted because there is an associated income' . $listAssociated);
        } catch (\Exception $e) {
            return redirect()->route('income-type.index')->with('errors', 'Something went wrong, the deletion did not happen!');
        }
    }
}
