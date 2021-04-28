<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class CostsType extends Model
{
    use HasFactory;

    /**
     * The name of the table in the database
     * @var string
     */
    protected $table = 'costs_types';

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
        'parent',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * Get cost types from costs
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function costs()
    {
        return $this->hasMany(Costs::class, 'type_id');
    }

    /**
     * Return name type, with key id cost type, by cost
     * @param $costs
     * @return array
     */
    public function getTypeNameByCosts(object $costs): array
    {
        $name = [];

        foreach ($costs as $cost) {
            $name[$cost->type_id] = parent::firstWhere('id', $cost->type_id)->name;
        }

        return $name;
    }

    public function getTypeNameById(int $id)
    {
        return parent::firstWhere('id', $id)->name;
    }

    /**
     * Get all costs type from user, in format object
     * If status field = 1
     * @return object
     */
    public function getType(): object
    {
        return parent::all()->where('user_id', Auth::id())->where('status', 1);
    }

    /**
     * Get all costs type from user, in format array with key by id
     * @return array
     */
    public function getTypeArray(): array
    {
        return parent::all()->where('user_id', Auth::id())->keyBy('id')->toArray();
    }

    /**
     * Delete cost type, if exist associated cost send error message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clean()
    {
        try {
            $this->delete();

            return redirect()->route('costs-type.index')->with('success', 'Deletion completed successfully!');
        } catch (QueryException $e) {
            $costsAssociated = CostsType::find($this->id)->costs;
            $listAssociated = view('errors.associated', ['ul' => $costsAssociated, 'delete' => 'costs']);

            return redirect()->route('costs-type.index')->with('errors', 'The type of costs cannot be deleted because there is an associated costs' . $listAssociated);
        } catch (\Exception $e) {
            return redirect()->route('costs-type.index')->with('errors', 'Something went wrong, the deletion did not happen!');
        }
    }
}
