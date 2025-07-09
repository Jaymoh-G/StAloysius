<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'amount',
        'message',
        'donation_type',
        'status',
        'reference',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function getFormattedAmountAttribute()
    {
        return 'KES ' . number_format($this->amount, 2);
    }

    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return '<span class="badge bg-warning">Pending</span>';
            case 'completed':
                return '<span class="badge bg-success">Completed</span>';
            case 'failed':
                return '<span class="badge bg-danger">Failed</span>';
            default:
                return '<span class="badge bg-secondary">Unknown</span>';
        }
    }
}
